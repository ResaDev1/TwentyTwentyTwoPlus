<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $result = 0;

        if (isset($_POST["checkSecondMenu"])) {
            $result = 1;
        }
        else {
            $result = 0;
        }

        match ($result) {
            0 => Db::replace(DB_TABLE, array("id" => 0, "param" => "secondMenu", "value" => "false"), array("%s", "%s")),
            1 => Db::replace(DB_TABLE, array("id" => 0, "param" => "secondMenu", "value" => "true"), array("%s", "%s")),
        };
    }

?>

<html>
    <style>
        .hidden {
            display: none;
        }

		main form {
		    display: flex;
		    flex-direction: column;
            align-items: baseline;
            margin-top: 1rem;
		}

        button {
            background: #a0a0a0;
            border: none;
        }

        input[type=submit] {
            background: none;
            border: 1px solid #a0a0a0;
            padding: 6px;
            cursor: pointer;
        }
    </style>

    <main>
        <h1>Twenty Twenty Two Plus control panel</h1>
        
        <form method="POST" action="">
            <div style="padding: 10px; display: flex; align-items: flex-end;">
                <label for="secondmenu" style="margin-left: 5px;">فهرست دوم</label>
                <?php 
                    $results = Db::get("SELECT value FROM wp_tttp WHERE id=0;");

                    echo match ($results[0]->value) {
                        "true" => '<input type="checkbox" name="checkSecondMenu" value="checked" checked>',
                        "false" => '<input type="checkbox" name="checkSecondMenu" value="checked">'
                    };
                ?>
            </div>

            <input type="submit" value="ثبت تغییرات" style="margin-top: 10px; margin-bottom: 10px;">
        </form>
        
    </main>
    <hr>
    <p>نسخه : <?php echo get_plugin_version(); ?></p>
    <button onclick="toggleLogs()" style="position: fixed; bottom: 2rem;">Logs</button>

    
    <textarea name="Logs" id="Logs" cols="60" rows="10" dir="ltr" class="hidden">
        <?php
            $messages = get_logs();
            foreach ($messages as $message) {
                echo $message . "\n";
            }
        ?>
    </textarea>
    <script>
        function toggleLogs() {
            document.getElementById("Logs").classList.toggle('hidden');
        }
    </script>
</html>