<html>
    <style>
        .hidden {
            display: none;
        }
    </style>

    <div>
        <h1>Twenty Twenty Plus control panel</h1>
        
        <button onclick="toggleLogs()">Logs</button>
        
        <textarea name="Logs" id="Logs" cols="60" rows="10" dir="ltr" class="hidden">
            Logs
            <?php
                $messages = get_logs();
                foreach ($messages as $message) {
                    echo $message . "\n";
                }
            ?>
        </textarea>
    </div>
    <script>
        function toggleLogs() {
            document.getElementById("Logs").classList.toggle('hidden');
        }
    </script>
</html>