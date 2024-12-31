<script>
    const dialog = document.querySelector('dialog');
    dialog.addEventListener( 'click', () => {
        dialog.removeAttribute('open');
        console.log('bye');
    });
</script>

</main>
</body>
</html>