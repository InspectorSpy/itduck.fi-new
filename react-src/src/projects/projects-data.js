// Authored write-up content for the projects page.
// "repo" matches the key the GitHub proxy returns, or null if the
// projects has no public repo (those get added later).
export const projects = [
    {
        title: "Home Server & Homelab",
        repo: "InspectorSpy/home-server",
        short: "A self-hosted server stacak running on a repurposed gaming laptop, handling photo backup, note sync, and a Minecraft server for friends, with proper reverse proxying and nightly backups.",
        stack: "Debian, Docker, Nginx Proxy Manager, Tailscale, Cloudflare DNS, Immich, CouchDB",
    },
    {
        title: "KaliaBot Dashboard",
        repo: "InspectorSpy/KaliaBot",
        short: "A FastAPI dashboard I built for a friend's Telegram drink-tracking bot, adding a leaderboard, stats, and admin tools on top of the existing bot.",
        stack: "Python, FastAPI, Jinja2, SQLite, Chart.js, Docker",
    },
]
