<div id="whatsapp-popup" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 9999; cursor: move;"
    ontouchstart="handleTouchStart(event)" ontouchmove="handleTouchMove(event)">
    <a href="https://wa.me/6281266187125?" target="_blank">
        <img src="{{ asset('public/assets/img/whatsapp.png') }}" alt="WhatsApp Icon" style="width: 50px; height: auto;"
            loading="lazy">
    </a>
    <div id="popup-message"
        style="display: none; position: absolute; top: -50px; left: -160px; background-color: #fff; padding: 10px; border: 1px solid #ccc;">
        hubungi Whatsapp kami
    </div>
</div>

<script>
    var initialX, initialY;
    var popup = document.getElementById('whatsapp-popup');
    var messagePopup = document.getElementById('popup-message');
    var isDragging = false;

    function showMessage() {
        messagePopup.style.display = 'block';
        setTimeout(function() {
            messagePopup.style.display = 'none';
        }, 2000);
    }

    function handleTouchStart(event) {
        isDragging = false;
        var touch = event.targetTouches[0];
        initialX = touch.clientX - parseInt(window.getComputedStyle(popup).getPropertyValue('left'));
        initialY = touch.clientY - parseInt(window.getComputedStyle(popup).getPropertyValue('top'));
    }

    function handleTouchMove(event) {
        if (!isDragging) return;
        var touch = event.targetTouches[0];
        var newX = touch.clientX - initialX;
        var newY = touch.clientY - initialY;
        popup.style.left = newX + 'px';
        popup.style.top = newY + 'px';
    }

    document.addEventListener('touchend', function() {
        isDragging = false;
    });

    setTimeout(function() {
        popup.style.display = 'block';
        showMessage();
    }, 300);
</script>
