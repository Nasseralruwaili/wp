<nav>
    <div class="header-left">
        <img src="images/logo.png" alt="Logo" id="logo">
        <script>
            function navigateTo(url) {
                if (url !== "") {
                    window.location.href = url;
                }
            }
        </script>
        <select onchange="navigateTo(this.value)">
            <option value="">Select an Option...</option>
            <option value="index.php">Home</option>
            <option value="hikes.php">Hikes</option>
            <option value="add.php">Add</option>
            <option value="gallery.php">Gallery</option>
        </select>
    </div>
    <div class="header-right">
        <input type="text" placeholder="Search...">
    </div>
</nav>

