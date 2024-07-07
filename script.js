document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.sidebar a');
    links.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.getAttribute('data-url');
            loadPage(url);
        });
    });

    async function loadPage(url) {
        try {
            console.log(`Loading page: ${url}`);
            const response = await fetch(url);
            if (response.ok) {
                const text = await response.text();
                document.getElementById('main-content').innerHTML = text;
                console.log(`Response received: ${text}`);
            } else {
                console.error(`Failed to load page: ${url}, Status: ${response.status}`);
                document.getElementById('main-content').innerHTML = `<p>Error: ${response.status}</p>`;
            }
        } catch (error) {
            console.error(`Error fetching page: ${error}`);
            document.getElementById('main-content').innerHTML = `<p>Error: ${error.message}</p>`;
        }
    }
});
