<header class='w-full flex items-center justify-center'>
    <div class='w-11/12 max-w-[1200px] flex items-center justify-between py-4'>
        <a id='home-link' class='text-3xl font-black uppercase'>Pi Accounting</a>
    </div>
</header>

<script>
    let homeLink = `${window.location.protocol}//${window.location.host}/`;
    document.getElementById('home-link').href = homeLink;
</script>
