<div class="vh-100 py-2 px-4">
    <p style="font-family: 'Sono', sans-serif; font-size:50px; color: aliceblue;">WORK SPACE</p>
    <p class="btn btn-outline-light bg-F7A76C">
        <?php
        date_default_timezone_set('UTC');
        $date = new DateTimeImmutable();
        echo $date->format('F jS\, Y'), "\n"; ?>
    </p>
</div>