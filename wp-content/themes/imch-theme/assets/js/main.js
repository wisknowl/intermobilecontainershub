/**
 * Intermobile Containers Hub (ICHub)
 * Main Theme JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // 0. Disable intrusive jQuery blockUI preloader overlays on Cart & Checkout
  if (window.jQuery && jQuery.blockUI) {
    jQuery.blockUI.defaults.overlayCSS = {
      backgroundColor: 'transparent',
      opacity: 0,
      cursor: 'default'
    };
    jQuery.blockUI.defaults.message = null;
    jQuery.blockUI.defaults.css = {
      display: 'none',
      opacity: 0
    };
  }

  // 1. Mobile Navigation Drawer
  const mobileToggle = document.getElementById('imch-mobile-toggle');
  const drawer = document.getElementById('imch-drawer');
  const overlay = document.getElementById('imch-drawer-overlay');
  const drawerClose = document.getElementById('imch-drawer-close');

  function openDrawer() {
    if (drawer && overlay) {
      drawer.classList.add('is-open');
      overlay.classList.add('is-active');
      document.body.style.overflow = 'hidden';
      if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'true');
    }
  }

  function closeDrawer() {
    if (drawer && overlay) {
      drawer.classList.remove('is-open');
      overlay.classList.remove('is-active');
      document.body.style.overflow = '';
      if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
    }
  }

  if (mobileToggle) mobileToggle.addEventListener('click', openDrawer);
  if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  // 2. Search Drawer Toggle
  const searchToggle = document.getElementById('imch-search-toggle');
  const searchDrawer = document.getElementById('imch-search-drawer');

  if (searchToggle && searchDrawer) {
    searchToggle.addEventListener('click', function () {
      const isActive = searchDrawer.classList.toggle('is-active');
      if (isActive) {
        const input = searchDrawer.querySelector('input[type="search"]');
        if (input) input.focus();
      }
    });
  }

  // 3. Single Product Gallery Thumbnail Switcher
  const mainImg = document.getElementById('imch-main-display-img');
  const thumbBtns = document.querySelectorAll('.imch-thumb-btn');

  if (mainImg && thumbBtns.length > 0) {
    thumbBtns.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const fullSrc = btn.getAttribute('data-full');
        if (fullSrc) {
          mainImg.setAttribute('src', fullSrc);
          thumbBtns.forEach(b => b.classList.remove('imch-thumb-active'));
          btn.classList.add('imch-thumb-active');
        }
      });
    });
  }

  // 4. Quote / Inquiry Modal
  const quoteModal = document.getElementById('imch-quote-modal');
  const quoteModalClose = document.getElementById('imch-quote-modal-close');
  const modalProductInput = document.getElementById('modal-product');
  const modalTitle = document.getElementById('imch-modal-title');

  function openQuoteModal(productName) {
    if (quoteModal) {
      quoteModal.classList.add('is-active');
      quoteModal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      if (modalProductInput && productName) {
        modalProductInput.value = productName;
      }
      if (modalTitle) {
        if (productName) {
          modalTitle.textContent = 'Inquire / Request Quote: ' + productName;
        } else {
          modalTitle.textContent = 'Request Container Quote';
        }
      }
    }
  }

  function closeQuoteModal() {
    if (quoteModal) {
      quoteModal.classList.remove('is-active');
      quoteModal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }
  }

  if (quoteModalClose) quoteModalClose.addEventListener('click', closeQuoteModal);
  if (quoteModal) {
    quoteModal.addEventListener('click', function (e) {
      if (e.target === quoteModal) closeQuoteModal();
    });
  }

  // 5. Slide-in Right Cart Drawer
  const cartDrawer = document.getElementById('imch-cart-drawer');
  const cartDrawerOverlay = document.getElementById('imch-cart-drawer-overlay');
  const cartDrawerClose = document.getElementById('imch-cart-drawer-close');
  const cartDrawerBody = document.getElementById('imch-cart-drawer-body');
  const cartDrawerFooter = document.getElementById('imch-cart-drawer-footer');
  const cartDrawerBadge = document.getElementById('imch-drawer-count-badge');
  const headerCartCounter = document.getElementById('imch-cart-counter');
  const headerCartTotal = document.querySelector('.imch-cart-total-text');

  function openCartDrawer() {
    if (cartDrawer && cartDrawerOverlay) {
      cartDrawer.classList.add('is-open');
      cartDrawerOverlay.classList.add('is-active');
      cartDrawer.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeCartDrawer() {
    if (cartDrawer && cartDrawerOverlay) {
      cartDrawer.classList.remove('is-open');
      cartDrawerOverlay.classList.remove('is-active');
      cartDrawer.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }
  }

  if (cartDrawerClose) cartDrawerClose.addEventListener('click', closeCartDrawer);
  if (cartDrawerOverlay) cartDrawerOverlay.addEventListener('click', closeCartDrawer);

  // Click on header cart pill opens the slide-in cart drawer unless on cart/checkout
  document.querySelectorAll('.imch-cart-pill').forEach(function (pill) {
    pill.addEventListener('click', function (e) {
      const currentPath = window.location.pathname;
      if (!currentPath.includes('/cart') && !currentPath.includes('/checkout')) {
        e.preventDefault();
        openCartDrawer();
      }
    });
  });

  // Global Click Delegations: Add to Cart, Inquire, Drawer Stepper, Drawer Remove
  document.addEventListener('click', function (e) {
    // 5A. Add to Cart Button on Product Cards
    const addBtn = e.target.closest('.imch-btn-add-cart');
    if (addBtn) {
      e.preventDefault();
      const productId = addBtn.getAttribute('data-product-id');
      if (!productId || addBtn.disabled) return;

      addBtn.disabled = true;
      const originalText = addBtn.innerHTML;
      addBtn.innerHTML = '<span>Adding...</span>';

      const formData = new FormData();
      formData.append('action', 'imch_ajax_add_to_cart');
      formData.append('product_id', productId);
      formData.append('quantity', '1');

      const ajaxUrl = (window.imchData && window.imchData.ajaxUrl) ? window.imchData.ajaxUrl : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          addBtn.disabled = false;
          addBtn.innerHTML = '<span>✓ Added!</span>';
          setTimeout(function () {
            addBtn.innerHTML = originalText;
          }, 1400);

          if (data.success) {
            if (cartDrawerBody && data.data.items_html) {
              cartDrawerBody.innerHTML = data.data.items_html;
            }
            if (cartDrawerFooter && data.data.footer_html) {
              cartDrawerFooter.innerHTML = data.data.footer_html;
            }
            if (cartDrawerBadge && typeof data.data.cart_count !== 'undefined') {
              cartDrawerBadge.textContent = data.data.cart_count;
            }
            if (headerCartCounter && typeof data.data.cart_count !== 'undefined') {
              headerCartCounter.textContent = data.data.cart_count;
            }
            if (headerCartTotal && data.data.cart_total) {
              headerCartTotal.innerHTML = data.data.cart_total;
            }
            openCartDrawer();
          }
        })
        .catch(err => {
          addBtn.disabled = false;
          addBtn.innerHTML = originalText;
          console.error('Error adding to cart:', err);
        });
      return;
    }

    // 5B. Inquire / Request Quote Button on Product Cards
    const inquireBtn = e.target.closest('.imch-btn-inquire, [data-quote-product], #imch-open-quote-modal');
    if (inquireBtn) {
      e.preventDefault();
      const product = inquireBtn.getAttribute('data-quote-product') || inquireBtn.getAttribute('data-product') || '';
      openQuoteModal(product);
      return;
    }

    // 5C. Drawer Quantity Stepper (+ / -)
    const drawerPlus = e.target.closest('.imch-drawer-qty-plus');
    const drawerMinus = e.target.closest('.imch-drawer-qty-minus');
    if (drawerPlus || drawerMinus) {
      e.preventDefault();
      const stepper = (drawerPlus || drawerMinus).closest('.imch-drawer-stepper');
      const key = stepper ? stepper.getAttribute('data-key') : '';
      if (!key) return;

      const actionType = drawerPlus ? 'plus' : 'minus';
      const formData = new FormData();
      formData.append('action', 'imch_drawer_qty');
      formData.append('cart_item_key', key);
      formData.append('action_type', actionType);

      const ajaxUrl = (window.imchData && window.imchData.ajaxUrl) ? window.imchData.ajaxUrl : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            if (cartDrawerBody && data.data.items_html) {
              cartDrawerBody.innerHTML = data.data.items_html;
            }
            if (cartDrawerFooter && data.data.footer_html) {
              cartDrawerFooter.innerHTML = data.data.footer_html;
            }
            if (cartDrawerBadge && typeof data.data.cart_count !== 'undefined') {
              cartDrawerBadge.textContent = data.data.cart_count;
            }
            if (headerCartCounter && typeof data.data.cart_count !== 'undefined') {
              headerCartCounter.textContent = data.data.cart_count;
            }
            if (headerCartTotal && data.data.cart_total) {
              headerCartTotal.innerHTML = data.data.cart_total;
            }
          }
        })
        .catch(err => console.error('Drawer qty update error:', err));
      return;
    }

    // 5D. Drawer Remove Item Button
    const removeBtn = e.target.closest('.imch-drawer-remove-btn');
    if (removeBtn) {
      e.preventDefault();
      const key = removeBtn.getAttribute('data-key');
      if (!key) return;

      const formData = new FormData();
      formData.append('action', 'imch_drawer_remove');
      formData.append('cart_item_key', key);

      const ajaxUrl = (window.imchData && window.imchData.ajaxUrl) ? window.imchData.ajaxUrl : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            if (cartDrawerBody && data.data.items_html) {
              cartDrawerBody.innerHTML = data.data.items_html;
            }
            if (cartDrawerFooter && data.data.footer_html) {
              cartDrawerFooter.innerHTML = data.data.footer_html;
            }
            if (cartDrawerBadge && typeof data.data.cart_count !== 'undefined') {
              cartDrawerBadge.textContent = data.data.cart_count;
            }
            if (headerCartCounter && typeof data.data.cart_count !== 'undefined') {
              headerCartCounter.textContent = data.data.cart_count;
            }
            if (headerCartTotal && data.data.cart_total) {
              headerCartTotal.innerHTML = data.data.cart_total;
            }
          }
        })
        .catch(err => console.error('Drawer remove item error:', err));
      return;
    }

    // 5E. Link inside Drawer that navigates to shop closes drawer
    if (e.target.closest('.imch-drawer-close-link')) {
      closeCartDrawer();
    }
  });

  // Close modals & drawers on Esc key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeDrawer();
      closeCartDrawer();
      closeQuoteModal();
    }
  });

  // 6. AJAX Form Handlers (Modal & Contact Page)
  function setupAjaxInquiryForm(formId, feedbackId, btnId) {
    const form = document.getElementById(formId);
    const feedback = document.getElementById(feedbackId);
    const submitBtn = document.getElementById(btnId);

    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.dataset.originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span>Sending Request...</span>';
      }

      if (feedback) {
        feedback.className = 'imch-form-feedback';
        feedback.style.display = 'none';
        feedback.innerHTML = '';
      }

      const formData = new FormData(form);
      formData.append('action', 'imch_submit_inquiry');
      formData.append('security', form.querySelector('[name="imch_nonce"]').value);

      fetch(window.imchData ? window.imchData.ajaxUrl : '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = submitBtn.dataset.originalText;
          }

          if (data.success) {
            form.reset();
            if (feedback) {
              feedback.classList.add('is-success');
              feedback.innerHTML = `
                <p><strong>✓ Request Received!</strong> ${data.data.message}</p>
                ${data.data.whatsapp_url ? `
                  <a href="${data.data.whatsapp_url}" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-sm" style="margin-top: 0.5rem;">
                    📲 Speed Up Delivery: Chat on WhatsApp Now
                  </a>
                ` : ''}
              `;
              feedback.style.display = 'block';
            }
          } else {
            if (feedback) {
              feedback.classList.add('is-error');
              feedback.textContent = data.data && data.data.message ? data.data.message : 'An error occurred. Please try again or call us directly.';
              feedback.style.display = 'block';
            }
          }
        })
        .catch(err => {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = submitBtn.dataset.originalText;
          }
          if (feedback) {
            feedback.classList.add('is-error');
            feedback.textContent = 'Connection error. Please call us at +1 (757) 906-8036 or chat on WhatsApp.';
            feedback.style.display = 'block';
          }
        });
    });
  }

  setupAjaxInquiryForm('imch-inquiry-form', 'imch-form-feedback', 'imch-submit-btn');
  setupAjaxInquiryForm('imch-contact-page-form', 'contact-form-feedback', 'contact-submit-btn');

  // 7. Cart Page Quantity Stepper (+ / -)
  document.addEventListener('click', function (e) {
    const plusBtn = e.target.closest('.imch-stepper-plus');
    const minusBtn = e.target.closest('.imch-stepper-minus');
    if (!plusBtn && !minusBtn) return;

    e.preventDefault();
    const stepper = (plusBtn || minusBtn).closest('.imch-stepper');
    if (!stepper) return;

    const input = stepper.querySelector('input.qty');
    if (!input) return;

    let val = parseInt(input.value, 10) || 1;
    const min = parseInt(input.getAttribute('min'), 10) || 0;
    const max = parseInt(input.getAttribute('max'), 10) || 999;

    if (plusBtn) {
      if (val < max) val++;
    } else if (minusBtn) {
      if (val > min) val--;
    }

    input.value = val;
    input.dispatchEvent(new Event('change', { bubbles: true }));

    // Automatically enable & trigger WooCommerce update cart button
    const updateBtn = document.querySelector('button[name="update_cart"]');
    if (updateBtn) {
      updateBtn.disabled = false;
      updateBtn.removeAttribute('aria-disabled');
      clearTimeout(window._imchCartTimer);
      window._imchCartTimer = setTimeout(function () {
        updateBtn.click();
      }, 500);
    }
  });
});
