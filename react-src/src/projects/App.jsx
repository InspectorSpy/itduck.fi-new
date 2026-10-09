import { useState, useEffect } from 'react'
import { projects } from './projects-data.js'

// Projects page component
function App() {
  // GitHub data from the proxy, keyed by "owner/repo"
    const [repos, setRepos] = useState({})
  // loading, done, error
    const [status, setStatus] = useState('loading')
  // Current text in the search box
    const [search, setSearch] = useState('')

  // useEffect with an empty [] runs onec, right after the first render.
  // This is where we fetch data, so the page does not wait for it.
    useEffect(() => {
        async function loadRepos() {
            try {
                const res = await fetch('/api/projects.php')
                const data = await res.json()
                if (data.success) {
                    setRepos(data.repos)
                    setStatus('done')
                } else {
                    setStatus('error')
                }
            } catch {
                setStatus('error')
          }
        }
        loadRepos()
    }, [])

    function handleSearchChange(e) {
        setSearch(e.target.value)
    }

  // keep only the projects whose text contains the search words.
  // Runs on every render, so it updates as you type.
    const query = search.toLowerCase().trim()
    const visibleProjects = projects.filter(function (project) {
        const text = (project.title + ' ' + project.short + ' ' + project.stack).toLowerCase()
        return text.includes(query)
    })

    return (
        <div>
            <div className="form-group">
                <label htmlFor="search">Search projects</label>
                <input
                    type="text"
                    id="search"
                    value={search}
                    onChange={handleSearchChange}
                    placeholder="Try docker, python, grafana..."
                    />
            </div>

            {status === 'loading' && <p>Loading GitHub data...</p>}
            {status === 'error' && (
                <p>Could not load live GitHub data, showing descriptions only.</p>
            )}
            {visibleProjects.length === 0 && <p>No projects match your search.</p>}

            <div className="features-grid">
                {visibleProjects.map(function (project) {
                  // Undefined for projects without a public repo
                    const github = repos[project.repo]
                    return (
                        <div className="feature-card" key={project.title}>
                            <h3>{project.title}</h3>
                            <p>{project.short}</p>
                            <p><strong>Stack:</strong> {project.stack}</p>
                            {github && (
                                <p>
                                    {github.language ? github.language + ' | ' : ''}
                                    Updated {new Date(github.updated_at).toLocaleDateString('fi-FI')}
                                    {' | '}
                                    <a href={github.url}>GitHub</a>
                                </p>
                            )}
                        </div>
                    )
              })}
            </div>
        </div>
    )
}

export default App
