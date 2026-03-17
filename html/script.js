const menuBtn = document.getElementById("menuBtn");
const navMenu = document.getElementById("navMenu");

if (menuBtn && navMenu) {
  menuBtn.addEventListener("click", () => {
    const expanded = menuBtn.getAttribute("aria-expanded") === "true";
    menuBtn.setAttribute("aria-expanded", String(!expanded));
    navMenu.classList.toggle("is-open");
  });

  navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      menuBtn.setAttribute("aria-expanded", "false");
      navMenu.classList.remove("is-open");
    });
  });
}

const reveals = document.querySelectorAll(".reveal");
const revealObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        revealObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.16 }
);

reveals.forEach((section) => revealObserver.observe(section));

const counters = document.querySelectorAll("[data-counter]");
const counterObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return;
      }

      const el = entry.target;
      const targetValue = Number(el.dataset.counter);
      const duration = 1100;
      const start = performance.now();

      function frame(now) {
        const progress = Math.min((now - start) / duration, 1);
        el.textContent = Math.floor(progress * targetValue).toString();
        if (progress < 1) {
          requestAnimationFrame(frame);
        } else {
          el.textContent = targetValue.toString();
        }
      }

      requestAnimationFrame(frame);
      counterObserver.unobserve(el);
    });
  },
  { threshold: 0.4 }
);

counters.forEach((counter) => counterObserver.observe(counter));

const chips = document.querySelectorAll(".chip");
const projectCards = document.querySelectorAll(".project");

chips.forEach((chip) => {
  chip.addEventListener("click", () => {
    chips.forEach((item) => item.classList.remove("is-active"));
    chip.classList.add("is-active");

    const filter = chip.dataset.filter;
    projectCards.forEach((card) => {
      const type = card.dataset.type;
      const shouldShow = filter === "all" || type === filter;
      card.classList.toggle("is-hidden", !shouldShow);
    });
  });
});

const lightbox = document.getElementById("lightbox");
const lightboxImage = document.getElementById("lightboxImage");
const lightboxClose = document.getElementById("lightboxClose");

function closeLightbox() {
  lightbox.classList.remove("is-open");
  lightbox.setAttribute("aria-hidden", "true");
  lightboxImage.src = "";
}

if (lightbox && lightboxImage && lightboxClose) {
  projectCards.forEach((card) => {
    card.addEventListener("click", () => {
      const image = card.querySelector("img");
      if (!image) {
        return;
      }
      lightboxImage.src = image.src;
      lightboxImage.alt = image.alt;
      lightbox.classList.add("is-open");
      lightbox.setAttribute("aria-hidden", "false");
    });
  });

  lightbox.addEventListener("click", (event) => {
    if (event.target === lightbox || event.target === lightboxClose) {
      closeLightbox();
    }
  });

  window.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeLightbox();
    }
  });
}
