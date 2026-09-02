import { useState } from 'react'

// Contact form component
function App() {

    // Erilliset state jokaiselle kolmelle fieldille
    // Jokainen useState() luo oman erillisen "laatikon" tilaa, alkuarvo
    // on tyhjä merkkijono (string). Yhden laatikon päivittäminen (esim. setName)
    // ei vaikuta muihin, ne ovat täysin toisistaan riippumattomia.
    const [name, setName] = useState('')
    const [email, setEmail] = useState('')
    const [message, setMessage] = useState('')

    // const [form, setForm] = useState({ name: '', email: '', message: '' })

    const [status, setStatus] = useState('idle') // idle, sending, success, error
    const [error, setError] = useState('')

    const csrfToken = document.getElementById('root').dataset.csrf

    /*
    function handleChange(e) {
        setForm({ ...form, [e.target.name]: e.target.value })
    }
    */

    // One handler per field. Each one just takes the new value straight
    // from the input and stores it in its own state variable.
    //
    // Selain tunnistaa jokaisen näppäimenpainalluksen inputissa ja
    // ja kutsuu tätä funktiota, aina kun kentän arvo muuttuu.
    // React kuuntelee tätä eventtiä onChange-propin kautta.
    // Kun eventti laukeaa, React kutsuu tätä funktiota ja antaa sille
    // "e" eli event-olion (event object) parametrina.
    //
    // e.target on DOM-elementti joka laukaisi eventin (itse <input>) ja
    // e.target.value on sen hetkinen teksti sen kentän sisällä.
    // setName(...) tallentaa sen Reactin tilaan, mikä laukaisee uudelleenrenderöinnin
    function handleNameChange(e) {
        setName(e.target.value)
    }

    function handleEmailChange(e) {
        setEmail(e.target.value)
    }

    function handleMessageChange(e) {
        setMessage(e.target.value)
    }

    // Handle form submission
    async function handleSubmit(e) {
        // Estää selaimen oletustoiminnon (sivun uudelleenlataus ja navigointi),
        // koska haluamme lähettää datan taustalla
        // ja pysyä samalla sivulla.
        e.preventDefault()

        // Päivitetään tila heti "sending"-tilaan, tämä on se mikä
        // saa napin poistumaan käytöstä ja näyttämään "Sending...",
        // ilman että pitää odottaa mitään.
        setStatus('sending')
        setError('')

        // Validate form fields
        try {
            // fetch() on selaimen sisäänrakennettu tapa tehdä HTTP-pyyntöjä
            // JavaScriptistä ilman sivun uudelleen latausta
            const res = await fetch('/api/contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                // Build the JSON body from the three separate state
                // variables here, instead of already having them
                // grouped in one object
                // OLD: body: JSON.stringify(form),
                // NEW: Groups the three variables into one object
                // and sends it as JSON
                //
                // { name, email, message } on lyhennysmerkintä, se
                // vastaa { name: name, email: email, message: message },
                // JS ymmärtää tämän jos muuttujan nimi on sama kuin
                // objektin avain.
                body: JSON.stringify({ name, email, message }),
            })

            // Await pysäyttää tämän funktion suorituksen (mutta ei koko sivua)
            // kunnes vastaus on oikeasti saapunut ja purettu JSON:ksi
            const data = await res.json()
            if (data.success) {
                setStatus('success')
            } else {
                setStatus('error')
                setError(data.error || 'Something went wrong. Please try again.')
            }
        } catch {
            // Tämä eroaa yllä olevasta else-haarasta: tänne päädytään jos
            // itse pyyntö epäonnistuu kokonaan (esim. ei nettiyhteyttä, palvelin alhaalla),
            // ei jos palvelin vastaa mutta sanoo "ei"
            setStatus('error')
            setError('Could not reach the server. Please try again later.')
        }
    }

    // Render the form or success message based on the status
    //
    // Tämä if-lause ajetaan JOKA KERTA kun komponentti renderöityy uudelleen.
    // Koska status on tilaa, ja tilan muutos laukaisee uudelleenrenderöinnin,
    // tämä on koko UI:n "aivot": kun setStatus ('success')
    // kutsutaan missä tahansa, React ajaa tämän funktion uudestaan,
    // ja tällä kertaa if on tosi, joten lomake katoaa
    // ja tilalle tulee onnistumisviesti. Ei manuaalista DOM:n käsittelyä.
    if (status === 'success') {
        return (
            <div className="alert alert-success">
                Thank you for your message! I'll get back to you shortly.
            </div>
        )
    }

    // Render the contact form
    return (
        <form className="contact-form" onSubmit={handleSubmit}>
            {status === 'error' && (
                <div className="alert alert-error">{error}</div>
            )}
            <div className="form-group">
                <label htmlFor="name">Name</label>
                {/*
                "Controlled input": value on AINA se mitä name-tila
                pitää sisällään juuri nyt, ei se mitä selain "muistaa"
                että kirjoitit. onChange kutsuu handleNameChangea joka
                päivittää tilan joka näppäinpainalluksella, jolloin
                React on aina "totuuden lähde" sille mitä kentässä on.
                */}
                <input
                    type="text"
                    id="name"
                    name="name"
                    // OLD: value={form.name}
                    // OLD: onChange={handleChange}
                    //
                    value={name}
                    onChange={handleNameChange}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    // OLD: value={form.email}
                    // OLD: onChange={handleChange}
                    value={email}
                    onChange={handleEmailChange}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="message">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="6"
                    // OLD: value={form.message}
                    // OLD: onChange={handleChange}
                    value={message}
                    onChange={handleMessageChange}
                    required
                />
            </div>
            <button type="submit" className="btn btn-primary" disabled={status === 'sending'}>
                {status === 'sending' ? 'Sending...' : 'Send Message'}
            </button>
        </form>
    )
}

export default App
