<script src="https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js"></script>

<section id="share">
    <div class="pos-abs-fill back-color-overlay back-filter-blur flex-center">
        <div class="flex-col-md w-auto pad-md back-color-prime bord-rad-md flex-center">
            <div class="flex-col font-center">
                <p class="font-size-lgr font-color-accent">Поделится</p>
                <p class="font-color-contrast">Передат</p>
            </div>


            <div class="flex-row-sm flex-center">
                <button class="speed-norm transform-scale-hover" data-sharer="whatsapp" data-title="{{ $title }}"
                    data-url="{{ route('phones.show', compact('phone')) }}"><img class="lock" height="42px"
                        src="https://img.icons8.com/material-outlined/48/whatsapp--v1.png" alt=""></button>

                <button class="speed-norm transform-scale-hover" data-sharer="telegram" data-title="{{ $title }}"
                    data-url="{{ route('phones.show', compact('phone')) }}"><img class="lock" height="42px"
                        src="https://img.icons8.com/material-outlined/48/telegram-app.png" alt=""></button>

                <button class="speed-norm transform-scale-hover" data-sharer="viber" data-title="{{ $title }}"
                    data-url="{{ route('phones.show', compact('phone')) }}"><img class="lock" height="42px"
                        src="https://img.icons8.com/material-outlined/96/viber.png" alt=""></button>

                <button class="speed-norm transform-scale-hover" data-sharer="skype"
                    data-url="{{ route('phones.show', compact('phone')) }}" data-title="{{ $title }}"><img
                        class="lock" height="42px" src="https://img.icons8.com/material-outlined/96/skype.png"
                        alt=""></button>

                <button class="speed-norm transform-scale-hover" data-sharer="vk" data-title="{{ $title }}"
                    data-url="{{ route('phones.show', compact('phone')) }}"><img class="lock" height="42px"
                        src="https://img.icons8.com/material-outlined/96/vk-com.png" alt=""></button>

                <button class="speed-norm transform-scale-hover" data-sharer="okru"
                    data-url="{{ route('phones.show', compact('phone')) }}" data-title="{{ $title }}"><img
                        class="lock" height="42px" src="https://img.icons8.com/material-outlined/96/ok-message.png"
                        alt=""></button>

            </div>

            <a href="#" id="close-share" class="close-btn">Закрыть</a>
        </div>
    </div>
</section>
