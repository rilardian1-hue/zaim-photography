// Preloader Logic
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.visibility = 'hidden';
            }, 800);
        }, 1500); // Wait for the text reveal animation
    }
});

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Custom Cursor Logic
    const cursor = document.getElementById('custom-cursor');
    const follower = document.getElementById('cursor-follower');
    
    if (cursor && follower) {
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;
        
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            // Instantly move the dot
            cursor.style.left = mouseX + 'px';
            cursor.style.top = mouseY + 'px';
        });

        // Smooth follow for the outer circle
        function animateFollower() {
            followerX += (mouseX - followerX) * 0.15;
            followerY += (mouseY - followerY) * 0.15;
            follower.style.left = followerX + 'px';
            follower.style.top = followerY + 'px';
            requestAnimationFrame(animateFollower);
        }
        animateFollower();

        // Add hover effects to clickable elements
        const hoverElements = document.querySelectorAll('a, button, input, textarea, select, .cursor-hover, .lightbox-trigger');
        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                document.body.classList.add('cursor-hovering');
                // Check if it's a lightbox trigger to show "LIHAT" text
                if (el.classList.contains('lightbox-trigger')) {
                    cursor.innerHTML = 'LIHAT';
                }
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-hovering');
                if (el.classList.contains('lightbox-trigger')) {
                    cursor.innerHTML = '';
                }
            });
        });
    }

    // 2. Intersection Observer for Scroll Animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.observe-element').forEach(el => {
        observer.observe(el);
    });

    // 3. Simple Parallax Effect
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        
        parallaxElements.forEach(el => {
            const speed = el.dataset.speed || 0.3;
            el.style.transform = `translateY(${scrolled * speed}px) scale(1.05)`;
        });
    });

    // 4. Lightbox Logic
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const triggers = document.querySelectorAll('.lightbox-trigger');
    const closeBtn = document.querySelector('.lightbox-close');

    if (lightbox && lightboxImg) {
        let typeWriterInterval;

        triggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                // Get the image source. If it's an img tag, get its src.
                // If it's a link surrounding an img, get the img src inside it or href.
                let imgSrc = '';
                if (trigger.tagName.toLowerCase() === 'img') {
                    imgSrc = trigger.src;
                } else {
                    const img = trigger.querySelector('img');
                    imgSrc = img ? img.src : trigger.href;
                }
                
                const title = trigger.getAttribute('data-title') || '';
                let description = trigger.getAttribute('data-description') || '';
                
                // Fallback for funny cat text if description is empty and we want to demo it
                // (Optional, we can just leave it empty if no description)

                const titleEl = document.getElementById('lightbox-title');
                const descEl = document.getElementById('lightbox-description');

                if (imgSrc) {
                    lightboxImg.src = imgSrc;
                    lightbox.classList.remove('hidden');
                    // Small delay to allow display:flex to apply before transition
                    setTimeout(() => {
                        lightbox.classList.add('opacity-100');
                    }, 10);

                    // Typewriter effect
                    clearInterval(typeWriterInterval);
                    titleEl.innerText = title;
                    descEl.innerHTML = '';
                    
                    if (description) {
                        let i = 0;
                        typeWriterInterval = setInterval(() => {
                            if (i < description.length) {
                                // Simple HTML escape to handle newlines
                                if (description.charAt(i) === '\n') {
                                    descEl.innerHTML += '<br>';
                                } else {
                                    descEl.innerHTML += description.charAt(i);
                                }
                                i++;
                            } else {
                                clearInterval(typeWriterInterval);
                            }
                        }, 30); // typing speed
                    }
                }
            });
        });

        const closeLightbox = () => {
            lightbox.classList.remove('opacity-100');
            clearInterval(typeWriterInterval);
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightboxImg.src = '';
                document.getElementById('lightbox-title').innerText = '';
                document.getElementById('lightbox-description').innerHTML = '';
            }, 500); // wait for transition
        };

        if (closeBtn) {
            closeBtn.addEventListener('click', closeLightbox);
        }

        lightbox.addEventListener('click', (e) => {
            // Close if clicking outside the image and text wrapper
            if (e.target === lightbox || e.target.classList.contains('lightbox-content-wrapper') || e.target.classList.contains('lightbox-image-container')) {
                closeLightbox();
            }
        });
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
                closeLightbox();
            }
        });
    }

    // 5. Magnetic Buttons
    const magneticElements = document.querySelectorAll('.magnetic-btn');
    magneticElements.forEach((el) => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            el.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
        });

        el.addEventListener('mouseleave', () => {
            el.style.transform = `translate(0px, 0px)`;
            el.style.transition = `transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)`;
        });
        
        el.addEventListener('mouseenter', () => {
            el.style.transition = `none`;
        });
    });

    // 6. 3D Tilt Effect
    const tiltElements = document.querySelectorAll('.tilt-effect');
    tiltElements.forEach(el => {
        el.addEventListener('mousemove', e => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = ((y - centerY) / centerY) * -15; // Max 15 deg
            const rotateY = ((x - centerX) / centerX) * 15;
            
            el.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            el.style.transition = 'none';
            el.style.zIndex = '10';
        });
        
        el.addEventListener('mouseleave', () => {
            el.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg)`;
            el.style.transition = 'transform 0.5s ease';
            el.style.zIndex = '1';
        });
    });
});
