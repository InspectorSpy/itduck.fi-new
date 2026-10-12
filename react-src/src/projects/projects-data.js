// Authored write-up content for the projects page.
// "repo" matches the key the GitHub proxy returns, or null if the
// project has no public repo (those cards show text only, for now).
export const projects = [
    {
        title: "Home Server & Homelab",
        repo: "InspectorSpy/home-server",
        short: "A self-hosted server stack running on a repurposed gaming laptop, handling photo backup, note sync, and a Minecraft server for friends, with proper reverse proxying and nightly backups.",
        stack: "Debian, Docker, Nginx Proxy Manager, Tailscale, Cloudflare DNS, Immich, CouchDB",
    },
    {
        title: "Monitoring Stack",
        repo: null,
        short: "A dedicated monitoring server tracking uptime and system health across all my infrastructure, built on Grafana, Prometheus, and Uptime Kuma.",
        stack: "Grafana, Prometheus, Uptime Kuma, node_exporter, cAdvisor, AlmaLinux",
    },
    {
        title: "Infrastructure Automation with Ansible",
        repo: null,
        short: "A private Ansible repo that bootstraps and maintains all three of my servers, from a single set of playbooks, and now doubles as a workstation backup for my Linux migration.",
        stack: "Ansible, ansible-vault, Debian, AlmaLinux, Docker, WSL2",
    },
    {
        title: "KaliaBot Dashboard",
        repo: "InspectorSpy/KaliaBot",
        short: "A FastAPI dashboard I built for a friend's Telegram drink-tracking bot, adding a leaderboard, stats, and admin tools on top of the existing bot.",
        stack: "Python, FastAPI, Jinja2, SQLite, Chart.js, Docker",
    },
    {
        title: "Disobey 2025/2026 hacker badge",
        repo: null,
        short: "A custom Pong game built for the MicroPython-based ESP32-S3 badge at Disobey 2026, plus a 3D-printed enclosure designed from the original PCB dimensions.",
        stack: "MicroPython, ESP32-S3, FreeCAD (Python scripting), 3D printing",
    },
    {
        title: "ATM Simulator (School Group Project)",
        repo: "InspectorSpy/ATM-Simulator",
        short: "A full-stack ATM simulator built for a university project: a secured Node.js/Express REST API paired with a Qt C++ desktop frontend.",
        stack: "Node.js, Express, MariaDB, JWT, Qt/C++, PM2",
    },
    {
        title: "Degoogling",
        repo: null,
        short: "An ongoing effort to move my personal computing off Google services, replacing them with self-hosted or privacy-respecting alternatives where practical.",
        stack: "ProtonMail, Cloudflare DNS, Immich, Bitwarden, Helium browser",
    },
]
