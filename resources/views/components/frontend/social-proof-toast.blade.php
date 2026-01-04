<div id="socialProofToast" class="social-proof-toast" aria-live="polite" aria-atomic="true" hidden>
    <div class="social-proof-toast__content">
        <div class="social-proof-toast__dot" aria-hidden="true"></div>
        <div class="social-proof-toast__text" data-social-proof-text></div>
        <button type="button" class="social-proof-toast__close" aria-label="Close" data-social-proof-close>
            &times;
        </button>
    </div>
</div>

<style>
.social-proof-toast {
    position: fixed;
    left: 50%;
    bottom: 16px;
    transform: translateX(-50%);
    z-index: 2147483000;
    display: flex;
    justify-content: center;
    pointer-events: none;
    width: auto;
}



.social-proof-toast__content {
    pointer-events: auto;
    width: 100%;
    border-radius: 14px;
    padding: 12px 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    transform: translateY(16px);
    opacity: 0;


    background: #f9f9fb;
    color: #1a1a1a;
    padding: 16px 28px;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    font-family: 'Segoe UI', 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 500;
    z-index: 99999;
    transition: all 0.4s ease;
    text-align: center;
    line-height: 1.5;
    background-image: linear-gradient(to right, #e3f2fd, #e8eaf6);
    border: 1px solid #cdd8f3;
}

.social-proof-toast.is-visible .social-proof-toast__content {
    transform: translateY(0);
    opacity: 1;
}

.social-proof-toast__dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 6px rgba(34,197,94,0.12);
    flex: 0 0 auto;
}

.social-proof-toast__text {
    font-size: 14px;
    line-height: 1.35;
    font-weight: 600;
    flex: 1 1 auto;
}

.social-proof-toast__close {
    appearance: none;
    border: none;
    background: transparent;
    color: rgba(255,255,255,0.85);
    font-size: 20px;
    line-height: 1;
    padding: 2px 8px;
    cursor: pointer;
    flex: 0 0 auto;
}

.social-proof-toast__close:hover {
    color: #ffffff;
}

@media (prefers-reduced-motion: reduce) {
    .social-proof-toast__content {
        transition: none;
    }
}

@media (max-width: 480px) {
    .social-proof-toast__text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 13px;
    }

    .social-proof-toast__content {
        padding: 12px 16px;
        max-width: 92vw;
    }
}

</style>

<script>
(function () {
    const root = document.getElementById('socialProofToast');
    if (!root) return;

    const textEl = root.querySelector('[data-social-proof-text]');
    const closeBtn = root.querySelector('[data-social-proof-close]');
    if (!textEl || !closeBtn) return;

    const messages = [
        '50+ reviews submitted in last 7 days',
        '20+ companies verified last week',
        '50+ new companies added last week',
        '100+ solar leads received in last 7 days',
        '30+ queries sorted last week'
    ];

    if (!messages.length) return;

    let timer = null;
    let hideTimer = null;
    let lastIndex = -1;

    const pickNextIndex = () => {
        if (messages.length === 1) return 0;
        let idx = Math.floor(Math.random() * messages.length);
        if (idx === lastIndex) {
            idx = (idx + 1) % messages.length;
        }
        lastIndex = idx;
        return idx;
    };

    const show = (message) => {
        textEl.textContent = message;
        root.hidden = false;
        requestAnimationFrame(() => {
            root.classList.add('is-visible');
        });

        clearTimeout(hideTimer);
        hideTimer = setTimeout(() => {
            root.classList.remove('is-visible');
        }, 4200);
    };

    const scheduleNext = () => {
        clearTimeout(timer);
        const delay = 6000 + Math.floor(Math.random() * 4000);
        timer = setTimeout(() => {
            show(messages[pickNextIndex()]);
            scheduleNext();
        }, delay);
    };

    const start = () => {
        setTimeout(() => {
            show(messages[pickNextIndex()]);
            scheduleNext();
        }, 2500);
    };

    const stop = () => {
        clearTimeout(timer);
        clearTimeout(hideTimer);
        root.classList.remove('is-visible');
        root.hidden = true;
    };

    closeBtn.addEventListener('click', function () {
        stop();
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start);
    } else {
        start();
    }
})();
</script>
