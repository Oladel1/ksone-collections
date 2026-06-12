/**
 * KS-One Footwear — Phase 2 JavaScript
 * Handles: smooth scrolling, navbar state, product filters, size selection,
 * Paystack payment, WhatsApp order, contact form, scroll reveal, mobile nav
 */

document.addEventListener('DOMContentLoaded', () => {

    // ── Navbar scroll effect ──────────────────────
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });


    // ── Mobile Nav Toggle ─────────────────────────
    const navToggle = document.getElementById('nav-toggle');
    const mobileNav = document.getElementById('mobile-nav');

    navToggle?.addEventListener('click', () => {
        navToggle.classList.toggle('active');
        mobileNav.classList.toggle('hidden');
        mobileNav.classList.toggle('open');
    });

    // Close mobile nav on link click
    document.querySelectorAll('.mobile-link').forEach(link => {
        link.addEventListener('click', () => {
            navToggle.classList.remove('active');
            mobileNav.classList.add('hidden');
            mobileNav.classList.remove('open');
        });
    });


    // ── Smooth Scroll for Anchor Links ────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = 80; // navbar height
                const y = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }
        });
    });


    // ── Product Filter Tabs ───────────────────────
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;

            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-[#1a1a1a]', 'text-white');
                b.classList.add('bg-white', 'text-[#555]');
            });
            btn.classList.add('active', 'bg-[#1a1a1a]', 'text-white');
            btn.classList.remove('bg-white', 'text-[#555]');

            // Filter products
            productCards.forEach(card => {
                const category = card.dataset.category;
                if (filter === 'all' || category === filter) {
                    card.classList.remove('hidden-card');
                    card.classList.add('visible-card');
                } else {
                    card.classList.add('hidden-card');
                    card.classList.remove('visible-card');
                }
            });
        });
    });


    // ── Size Selection ────────────────────────────
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.dataset.product;
            // Deselect siblings
            document.querySelectorAll(`.size-btn[data-product="${productId}"]`).forEach(s => {
                s.classList.remove('selected');
            });
            btn.classList.add('selected');

            // Enable WhatsApp order button for this product
            const orderBtn = document.querySelector(`.order-btn[data-product-id="${productId}"]`);
            if (orderBtn) {
                orderBtn.disabled = false;
            }
        });
    });


    // ── Payment Modal ─────────────────────────────
    const modal = document.getElementById('payment-modal');
    const modalCard = document.getElementById('modal-card');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const modalClose = document.getElementById('modal-close');
    let currentProduct = null;

    function openModal(product) {
        currentProduct = product;

        // Populate modal
        document.getElementById('modal-product-name').textContent = product.name;
        document.getElementById('modal-product-price').textContent = '₦' + parseInt(product.price).toLocaleString();
        document.getElementById('modal-product-size').textContent = product.size || '—';
        document.getElementById('pay-btn-text').textContent = 'Pay ₦' + parseInt(product.price).toLocaleString();

        const img = document.getElementById('modal-product-image');
        if (product.image) {
            img.src = product.image;
            img.alt = product.name;
        }

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            modalCard.classList.remove('scale-95', 'opacity-0');
            modalCard.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeModal() {
        modalCard.classList.add('scale-95', 'opacity-0');
        modalCard.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            currentProduct = null;
        }, 200);
    }

    modalClose?.addEventListener('click', closeModal);
    modalBackdrop?.addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && currentProduct) closeModal();
    });


    // ── Buy Now Button → Open Payment Modal ──────
    document.querySelectorAll('.pay-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.dataset.productId;
            const selectedSize = document.querySelector(`.size-btn[data-product="${productId}"].selected`);

            if (!selectedSize) {
                // Flash the size buttons to prompt selection
                const sizeBtns = document.querySelectorAll(`.size-btn[data-product="${productId}"]`);
                sizeBtns.forEach(s => {
                    s.classList.add('ring-2', 'ring-red-400');
                    setTimeout(() => s.classList.remove('ring-2', 'ring-red-400'), 1500);
                });
                return;
            }

            openModal({
                id: productId,
                name: btn.dataset.productName,
                price: btn.dataset.productPrice,
                image: btn.dataset.productImage,
                size: selectedSize.dataset.size
            });
        });
    });


    // ── Paystack Payment ──────────────────────────
    const paySubmit = document.getElementById('pay-submit');
    paySubmit?.addEventListener('click', () => {
        const name = document.getElementById('pay-name').value.trim();
        const email = document.getElementById('pay-email').value.trim();
        const phone = document.getElementById('pay-phone').value.trim();

        if (!name || !email || !phone) {
            // Highlight empty fields
            ['pay-name', 'pay-email', 'pay-phone'].forEach(id => {
                const el = document.getElementById(id);
                if (!el.value.trim()) {
                    el.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                    setTimeout(() => el.classList.remove('border-red-400', 'ring-1', 'ring-red-400'), 2000);
                }
            });
            return;
        }

        if (!currentProduct) return;

        const config = window.KS_CONFIG || {};
        const paystackKey = config.paystackKey;

        if (!paystackKey) {
            alert('Payment is not configured yet. Please order via WhatsApp.');
            return;
        }

        // Generate unique reference
        const ref = 'KS-' + Date.now() + '-' + Math.random().toString(36).substring(2, 7).toUpperCase();

        // Disable button
        paySubmit.disabled = true;
        document.getElementById('pay-btn-text').textContent = 'Processing...';

        try {
            const paystack = new PaystackPop();
            paystack.newTransaction({
                key: paystackKey,
                email: email,
                amount: parseInt(currentProduct.price) * 100, // Convert to kobo
                currency: 'NGN',
                ref: ref,
                metadata: {
                    custom_fields: [
                        { display_name: "Customer Name", variable_name: "customer_name", value: name },
                        { display_name: "Phone", variable_name: "phone", value: phone },
                        { display_name: "Product", variable_name: "product", value: currentProduct.name },
                        { display_name: "Size", variable_name: "size", value: currentProduct.size },
                        { display_name: "Product ID", variable_name: "product_id", value: currentProduct.id }
                    ]
                },
                onSuccess: (transaction) => {
                    // Close payment modal
                    closeModal();

                    // Verify on backend
                    verifyPayment(transaction.reference, name, phone);

                    // Show success toast
                    showSuccessToast(transaction.reference);

                    // Reset button
                    paySubmit.disabled = false;
                    document.getElementById('pay-btn-text').textContent = 'Pay ₦' + parseInt(currentProduct?.price || 0).toLocaleString();
                },
                onCancel: () => {
                    paySubmit.disabled = false;
                    document.getElementById('pay-btn-text').textContent = 'Pay ₦' + parseInt(currentProduct?.price || 0).toLocaleString();
                }
            });
        } catch (err) {
            console.error('Paystack error:', err);
            paySubmit.disabled = false;
            document.getElementById('pay-btn-text').textContent = 'Pay ₦' + parseInt(currentProduct?.price || 0).toLocaleString();
            alert('Could not initiate payment. Please try again or order via WhatsApp.');
        }
    });

    function verifyPayment(reference, customerName, phone) {
        const config = window.KS_CONFIG || {};
        fetch(config.verifyUrl || '/api/paystack/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': config.csrfToken || document.querySelector('meta[name="csrf-token"]')?.content
            },
            body: JSON.stringify({ reference, customer_name: customerName, phone })
        }).catch(err => console.log('Verification request sent', err));
    }

    function showSuccessToast(ref) {
        const toast = document.getElementById('success-toast');
        document.getElementById('success-ref').textContent = ref;
        toast.classList.remove('hidden');
        requestAnimationFrame(() => {
            toast.classList.remove('-translate-y-4', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        });
        setTimeout(() => {
            toast.classList.add('-translate-y-4', 'opacity-0');
            toast.classList.remove('translate-y-0', 'opacity-100');
            setTimeout(() => toast.classList.add('hidden'), 300);
        }, 6000);
    }


    // ── WhatsApp Order Button ─────────────────────
    document.querySelectorAll('.order-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const name = btn.dataset.productName;
            const price = parseInt(btn.dataset.productPrice).toLocaleString();
            const whatsapp = btn.dataset.whatsapp;
            const productId = btn.dataset.productId;

            // Get selected size — require it before proceeding
            const selectedSize = document.querySelector(`.size-btn[data-product="${productId}"].selected`);
            if (!selectedSize) {
                // Flash the size buttons to prompt selection
                const sizeBtns = document.querySelectorAll(`.size-btn[data-product="${productId}"]`);
                sizeBtns.forEach(s => {
                    s.classList.add('ring-2', 'ring-red-400');
                    setTimeout(() => s.classList.remove('ring-2', 'ring-red-400'), 1500);
                });
                return;
            }

            const size = selectedSize.dataset.size;

            // Build WhatsApp message
            const message = `Hello KS-One! I'd like to order:\n\n` +
                          `📦 Product: ${name}\n` +
                          `📏 Size: ${size}\n` +
                          `💰 Price: ₦${price}\n\n` +
                          `Please confirm availability. Thank you!`;

            window.open(`https://wa.me/${whatsapp}?text=${encodeURIComponent(message)}`, '_blank');
        });
    });


    // ── Contact Form → WhatsApp ───────────────────
    const contactForm = document.getElementById('contact-form');
    contactForm?.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = document.getElementById('form-name').value.trim();
        const message = document.getElementById('form-message').value.trim();

        if (!name || !message) return;

        const text = `Hello KS-One!\n\nMy name is ${name}.\n\n${message}`;
        window.open(`https://wa.me/2347035515612?text=${encodeURIComponent(text)}`, '_blank');
    });


    // ── Scroll Reveal ─────────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

});
