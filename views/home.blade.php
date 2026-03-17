<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ trim(strip_tags($pagetitle ?: 'ООО СТК Астэрия — Строительная компания')) }}</title>
  <meta name="description" content="{{ trim(strip_tags($introtext ?: 'ООО СТК Астэрия — генподрядные работы: от нулевого цикла до ввода объекта в эксплуатацию.')) }}">
  <link rel="icon" href="/html/favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Unbounded:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/html/styles.css">
</head>
<body>
  <div class="bg-orb orb-1" aria-hidden="true"></div>
  <div class="bg-orb orb-2" aria-hidden="true"></div>

  <header class="topbar" id="top">
    <div class="container nav-wrap">
      <a href="#top" class="brand">
        <span class="brand-mark">А</span>
        <span class="brand-text">{{ $companyName ?: 'СТК Астэрия' }}</span>
      </a>
      <button class="menu-btn" id="menuBtn" aria-label="Открыть меню" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <nav class="nav" id="navMenu">
        <a href="#about">О компании</a>
        <a href="#services">Услуги</a>
        <a href="#projects">Объекты</a>
        <a href="#contact">Контакты</a>
      </nav>
      <a class="btn btn-tonal" href="tel:{{ $companyPhoneHref ?: '+79103902890' }}">Позвонить</a>
    </div>
  </header>

  <main>
    <section class="hero container reveal">
      <p class="eyebrow">С 2012 года на рынке строительства</p>
      <h1>{!! $pagetitle !!}</h1>
      <p class="hero-text">{!! $introtext !!}</p>
      <div class="hero-actions">
        <a class="btn btn-filled" href="#contact">Обсудить проект</a>
        <a class="btn btn-outlined" href="/html/assets/asteria.pdf" target="_blank" rel="noopener">Скачать презентацию</a>
      </div>
      <div class="stats-grid">
        <article class="surface stat-card">
          <p class="stat-value" data-counter="15">0</p>
          <p class="stat-label">лет опыта и экспертизы</p>
        </article>
        <article class="surface stat-card">
          <p class="stat-value" data-counter="{{ $portfolioCount ?: 0 }}">0</p>
          <p class="stat-label">ключевых объектов в портфолио</p>
        </article>
        <article class="surface stat-card">
          <p class="stat-value" data-counter="100">0</p>
          <p class="stat-label">контроль качества, %</p>
        </article>
      </div>
    </section>

    <section class="container section reveal" id="about">
      <div class="section-head">
        <p class="eyebrow">О компании</p>
        <h2>Надежный партнер для жилых и коммерческих проектов</h2>
      </div>
      <div class="about-grid">
        <article class="surface card">
          <h3>Кто мы</h3>
          <p>
            Наименование организации: ООО «СТК Астэрия». Учредитель и директор — Сесин Александр Владимирович.
            Мы объединяем опытную команду инженеров и строителей для реализации объектов любой сложности.
          </p>
        </article>
        <article class="surface card">
          <h3>Подход</h3>
          <p>
            Работаем прозрачно и поэтапно: формируем понятные сроки, контролируем качество на каждом участке,
            используем современные технологии и практики устойчивого строительства.
          </p>
        </article>
        <article class="surface card">
          <h3>Производственная база</h3>
          <p>
            У компании есть собственное производство изделий из тонколистовой стали и площадки
            для временного хранения материалов и оборудования.
          </p>
        </article>
        <article class="surface card">
          <h3>Результат</h3>
          <p>
            Для нас каждый проект — это долгосрочная ценность для клиента и города. Мы нацелены на стабильное
            сотрудничество и предсказуемый результат без компромиссов по качеству.
          </p>
        </article>
      </div>
    </section>

    <section class="container section reveal" id="services">
      <div class="section-head">
        <p class="eyebrow">Услуги</p>
        <h2>Полный цикл строительных работ</h2>
      </div>
      <div class="services-grid">
        <article class="surface service-card">
          <h3>Генподряд</h3>
          <p>Комплексное управление проектом: планирование, координация подрядчиков, контроль сроков и бюджета.</p>
        </article>
        <article class="surface service-card">
          <h3>Общестроительные работы</h3>
          <p>Строительство конструктивов и инженерная подготовка объекта в соответствии с проектной документацией.</p>
        </article>
        <article class="surface service-card">
          <h3>Вентиляция и кондиционирование</h3>
          <p>Проектирование и монтаж систем для комфортной, безопасной и энергоэффективной эксплуатации.</p>
        </article>
        <article class="surface service-card">
          <h3>Сопровождение до ввода</h3>
          <p>Работы от нулевого цикла до получения разрешения на ввод объекта в эксплуатацию.</p>
        </article>
      </div>
    </section>

    <section class="container section reveal" id="projects">
      <div class="section-head">
        <p class="eyebrow">Выполненные объекты</p>
        <h2>Реальные кейсы в Нижнем Новгороде</h2>
      </div>

      <div class="chips" role="tablist" aria-label="Фильтр проектов">
        <button class="chip is-active" data-filter="all">Все</button>
        <button class="chip" data-filter="residential">Жилые комплексы</button>
        <button class="chip" data-filter="commercial">Коммерческие</button>
        <button class="chip" data-filter="private">Частные</button>
      </div>

      <div class="project-grid" id="projectGrid">
        @forelse ($portfolioItems ?? [] as $index => $item)
          <figure class="surface project" data-type="{{ $item['type'] }}">
            @if (!empty($item['image']))
              <img src="/{{ ltrim($item['image'], '/') }}" alt="{{ $item['title'] }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" @if ($index === 0) fetchpriority="high" @endif decoding="async">
            @endif
            <figcaption>{{ $item['title'] }}</figcaption>
          </figure>
        @empty
          <figure class="surface project" data-type="residential">
            <img src="/html/images/zhk-prioksky.jpg" alt="ЖК Приокский" loading="eager" fetchpriority="high" decoding="async">
            <figcaption>Заполните MultiTV `portfolio-item` в админке</figcaption>
          </figure>
        @endforelse
      </div>

      <article class="surface project-list">
        <h3>Участвовали в строительстве</h3>
        <ul>
          <li>ЖК Приокский, ул. Маршала Жукова, д. 8к1</li>
          <li>ЖК Солнечный, ул. Композитора Касьянова, д. 13к1 и 13к2</li>
          <li>ЖК Гелиос, ул. Композитора Касьянова, д. 11</li>
          <li>Коммерческое здание, проспект Героев, 23А</li>
          <li>Здание под магазин, г. Кстово, ул. Советская, 30</li>
          <li>ИЖС и частные проекты, строительство коттеджей премиум-класса</li>
        </ul>
      </article>
    </section>

    <footer class="container section reveal" id="contact">
      <article class="surface contact-card">
        <div>
          <p class="eyebrow">Связь</p>
          <h2>{{ $companyName ?: 'ООО «СТК Астэрия»' }}</h2>
          <p>Расскажите задачу, и мы предложим оптимальный путь реализации с понятными этапами и сроками.</p>
        </div>
        <div class="contact-items">
          <a class="contact-link" href="tel:{{ $companyPhoneHref ?: '+79103902890' }}">{{ $companyPhone ?: '+7 (910) 390-28-90' }}</a>
          <p>Директор: Сесин Александр Владимирович</p>
          <p>ИНН/КПП: 5258104853 / 525801001</p>
          <p>Адрес: г. Нижний Новгород, ул. Республиканская, 24В</p>
        </div>
      </article>
    </footer>
  </main>

  <div class="lightbox" id="lightbox" aria-hidden="true">
    <button class="lightbox-close" id="lightboxClose" aria-label="Закрыть">x</button>
    <img id="lightboxImage" alt="Увеличенное фото объекта">
  </div>

  <script src="/html/script.js"></script>
</body>
</html>
