<div class="swiper-slide p-2">
    <div class="tracker-slide">
        <span class="tracker-slide__date">{{ $tracker_card->timestamp }}</span>
        <h4 class="tracker-slide__temperature title">Температура: {{ $tracker_card->temperature }}</h4>
        <h4 class="tracker-slide__health title">Состояние: {{ $tracker_card->health_rate }}</h4>
    </div>
</div>
