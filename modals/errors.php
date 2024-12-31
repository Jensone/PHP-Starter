<dialog open>
    <article>
        <header>
            <p>
                <strong>🚨 Une erreur s'est produite</strong>
            </p>
        </header>
        <ul>
            <?php
                foreach($_SESSION['errors'] as $error) {
                    echo "<li>$error</li>";
                }
            ?>
        </ul>
    </article>
</dialog>