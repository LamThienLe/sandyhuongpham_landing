/* SHP Theme – main.js */
(function () {
  'use strict';

  /* ============================================================
     HEADER SCROLL EFFECT
     ============================================================ */
  var header = document.getElementById('site-header');

  function onScroll() {
    if (!header) return;
    if (window.scrollY > 60) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run on load


  /* ============================================================
     HAMBURGER / MOBILE NAV
     ============================================================ */
  var toggle    = document.querySelector('.menu-toggle');
  var mobileNav = document.getElementById('mobile-nav');
  var body      = document.body;

  if (toggle) {
    toggle.addEventListener('click', function () {
      var expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', String(!expanded));
      this.classList.toggle('is-active');
      body.classList.toggle('mobile-nav-open');
      if (mobileNav) {
        mobileNav.setAttribute('aria-hidden', String(expanded));
      }
    });
  }

  // Close mobile nav on Escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && body.classList.contains('mobile-nav-open')) {
      body.classList.remove('mobile-nav-open');
      if (toggle) {
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
      }
      if (mobileNav) {
        mobileNav.setAttribute('aria-hidden', 'true');
      }
    }
  });


  /* ============================================================
     MOBILE DROPDOWN TOGGLES
     ============================================================ */
  function initMobileDropdowns() {
    var parentItems = document.querySelectorAll('#mobile-nav .menu-item-has-children > a');

    parentItems.forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (window.innerWidth <= 768 && body.classList.contains('mobile-nav-open')) {
          e.preventDefault();
          var subMenu = this.nextElementSibling;
          if (subMenu && subMenu.classList.contains('sub-menu')) {
            subMenu.classList.toggle('is-open');
            this.setAttribute(
              'aria-expanded',
              subMenu.classList.contains('is-open') ? 'true' : 'false'
            );
          }
        }
      });
    });
  }

  initMobileDropdowns();


  /* ============================================================
     SCROLL REVEAL
     ============================================================ */
  var revealEls = document.querySelectorAll('.reveal');

  if ('IntersectionObserver' in window && revealEls.length) {
    var revealObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    revealEls.forEach(function (el) {
      revealObserver.observe(el);
    });
  } else {
    // Fallback: show all immediately
    revealEls.forEach(function (el) {
      el.classList.add('is-visible');
    });
  }


  /* ============================================================
     CONNECT FORM (AJAX)
     ============================================================ */
  var connectForm = document.getElementById('shp-connect-form');

  if (connectForm && typeof shpData !== 'undefined') {
    var feedback = connectForm.querySelector('.connect-form__feedback');
    var submitBtn = connectForm.querySelector('[type="submit"]');

    connectForm.addEventListener('submit', function (e) {
      e.preventDefault();

      var name    = connectForm.querySelector('#shp_name').value.trim();
      var email   = connectForm.querySelector('#shp_email').value.trim();
      var message = connectForm.querySelector('#shp_message').value.trim();

      if (!name || !email || !message) {
        showFeedback('Vui lòng điền đầy đủ thông tin.', 'error');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.textContent = 'Đang gửi…';

      var formData = new FormData();
      formData.append('action',      'shp_connect');
      formData.append('nonce',       shpData.nonce);
      formData.append('shp_name',    name);
      formData.append('shp_email',   email);
      formData.append('shp_message', message);

      fetch(shpData.ajaxUrl, {
        method: 'POST',
        body: formData,
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (data.success) {
            showFeedback(data.data.message, 'success');
            connectForm.reset();
          } else {
            showFeedback(data.data.message || 'Có lỗi xảy ra. Vui lòng thử lại.', 'error');
          }
        })
        .catch(function () {
          showFeedback('Không thể kết nối. Vui lòng thử lại sau.', 'error');
        })
        .finally(function () {
          submitBtn.disabled = false;
          submitBtn.textContent = 'GỬI';
        });
    });

    function showFeedback(msg, type) {
      if (!feedback) return;
      feedback.textContent = msg;
      feedback.style.color = type === 'success' ? 'var(--accent)' : '#c0392b';
    }
  }


  /* ============================================================
     SMOOTH ANCHOR SCROLL
     ============================================================ */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });


  /* ============================================================
     IMAGE LAZY LOAD (native + polyfill)
     ============================================================ */
  if ('loading' in HTMLImageElement.prototype) {
    // Browser supports native lazy loading; nothing extra needed.
  } else {
    // Fallback: add IntersectionObserver-based lazy load
    var lazyImgs = document.querySelectorAll('img[loading="lazy"]');
    if ('IntersectionObserver' in window) {
      var lazyObs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            var img = entry.target;
            if (img.dataset.src) img.src = img.dataset.src;
            lazyObs.unobserve(img);
          }
        });
      });
      lazyImgs.forEach(function (img) { lazyObs.observe(img); });
    }
  }


  /* ============================================================
     CATEGORY TAB UI (if present on page)
     ============================================================ */
  var tabBtns = document.querySelectorAll('[data-tab-btn]');
  var tabPanels = document.querySelectorAll('[data-tab-panel]');

  if (tabBtns.length) {
    tabBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var target = this.dataset.tabBtn;

        tabBtns.forEach(function (b) {
          b.classList.toggle('is-active', b.dataset.tabBtn === target);
          b.setAttribute('aria-selected', b.dataset.tabBtn === target ? 'true' : 'false');
        });

        tabPanels.forEach(function (panel) {
          panel.hidden = panel.dataset.tabPanel !== target;
        });
      });
    });
  }

})();
