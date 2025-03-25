<!-- Footer -->
<style>
    .main-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 20px;
    background: #f8f9fa; /* Adjust as needed */
    font-size: 14px;
    height: 40px; /* Reduce height */
}

</style>
<footer class="main-footer bg-white">
    <strong>AS-RAMD_Copyright &copy; 2024</strong>
    <div class="float-right d-none d-sm-inline">
        <span id="datetime"></span>
    </div>
</footer>

<script>
    function updateDateTime() {
        const now = new Date();
        const formattedDateTime = now.toLocaleString('en-US', {
            year: 'numeric', month: 'long', day: 'numeric',
            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true
        });
        document.getElementById("datetime").textContent = formattedDateTime;
    }

    setInterval(updateDateTime, 1000); // Update every second
    updateDateTime(); // Initialize on page load
</script>
