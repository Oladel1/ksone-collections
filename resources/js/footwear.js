/**
 * KS-One Footwear — Phase 2 JavaScript
 * Handles: smooth scrolling, navbar state, product filters, size selection,
 * order button (WhatsApp + Paystack ready), contact form, scroll reveal, mobile nav
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
        });
    });


    // ── Order Button (WhatsApp for now, Paystack ready) ──
    document.querySelectorAll('.order-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const name = btn.dataset.productName;
            const price = parseInt(btn.dataset.productPrice).toLocaleString();
            const whatsapp = btn.dataset.whatsapp;
            const productId = btn.dataset.productId;

            // Get selected size
            const selectedSize = document.querySelector(`.size-btn[data-product="${productId}"].selected`);
            const size = selectedSize ? selectedSize.dataset.size : 'not selected';

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
