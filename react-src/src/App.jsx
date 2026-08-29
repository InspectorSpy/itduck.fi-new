import { useState } from 'react'

// Contact form component
function App() {
    const [form, setForm] = useState({ name: '', email: '', message: '' })
    const [status, setStatus] = useState('idle') // idle, sending, success, error
    const [error, setError] = useState('')
    const csrfToken = document.getElementById('root').dataset.csrf

    function handleChange(e) {
        setForm({ ...form, [e.target.name]: e.target.value })
    }

    // Handle form submission
    async function handleSubmit(e) {
        e.preventDefault()
        setStatus('sending')
        setError('')

        // Validate form fields
        try {
            const res = await fetch('/api/contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                body: JSON.stringify(form),
            })
            const data = await res.json()
            if (data.success) {
                setStatus('success')
            } else {
                setStatus('error')
                setError(data.error || 'Something went wrong. Please try again.')
            }
        } catch {
            setStatus('error')
            setError('Could not reach the server. Please try again later.')
        }
    }

    // Render the form or success message based on the status
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
                <input
                    type="text"
                    id="name"
                    name="name"
                    value={form.name}
                    onChange={handleChange}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value={form.email}
                    onChange={handleChange}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="message">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="6"
                    value={form.message}
                    onChange={handleChange}
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
