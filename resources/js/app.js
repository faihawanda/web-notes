import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { tsParticles } from "tsparticles-engine";
import { loadSlim } from "tsparticles-slim";

import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

// Hani kode
async function loadParticles() {

   await loadSlim(tsParticles);

   await tsParticles.load({
       id: "particles",
       options: {
           particles: {
               number: { value: 300 },
               color: { value: "#ffffff" },
               shape: { type: ["circle", "square"] },
               opacity: { value: 1 },
               size: { value: 3 },
               move: {
                   enable: true,
                   speed: 0.3
               }
           },
           background: {
               color: "#2D2DFF"
           }
       }
   });
}

if (document.getElementById("particles")) {
   loadParticles();
}

// MENU
const menuBtn = document.getElementById("menuBtn");
const popupMenu = document.getElementById("popupMenu");
const menuText = document.getElementById("menuText");
if (menuBtn && popupMenu && menuText) {

   let isOpen = false;

   menuBtn.addEventListener("click", () => {

       isOpen = !isOpen;

       if (isOpen) {
           popupMenu.classList.remove("hidden");
           menuText.innerText = "CLOSE";
       } else {
           popupMenu.classList.add("hidden");
           menuText.innerText = "MENU";
       }
   });
}

// ABOUT SECTION
const aboutText = document.querySelector(".about-title");
if (aboutText) {

   const words = aboutText.innerText.split(" ");

   aboutText.innerHTML = words
       .map(word => `<span class="word">${word}</span>`)
       .join(" ");

   gsap.set(".word", {
       opacity: 0,
       y: 60
   });

   gsap.to(".word", {
       opacity: 1,
       y: 0,
       stagger: .05,
       duration: 1,
       scrollTrigger: {
           trigger: "#about",
           start: "top 70%"
       }
   });
}

// FEATURE CARDS
const cards = document.querySelectorAll(".card");
if (cards.length) {

   gsap.set(cards, {
       xPercent: -50,
       x: 0,
       y: 150,
       rotation: 0,
       opacity: 0,
       scale: .8
   });

   gsap.to(cards, {
       y: 0,
       opacity: 1,
       scale: 1,
       stagger: .15,
       duration: 1.2,
       ease: "power4.out",
       scrollTrigger: {
           trigger: "#feature",
           start: "top 80%"
       }
   });

   ScrollTrigger.create({
       trigger: "#feature",
       start: "top center",

       onEnter: () => {

           gsap.to(".strategy", {
               x: -520,
               rotation: -18,
               duration: 1.5,
               ease: "power3.out"
           });


           gsap.to(".creative", {
               x: -180,
               rotation: -8,
               duration: 1.5,
               ease: "power3.out"
           });


           gsap.to(".tech", {
               x: 180,
               rotation: 8,
               duration: 1.5,
               ease: "power3.out"
           });


           gsap.to(".production", {
               x: 520,
               rotation: 18,
               duration: 1.5,
               ease: "power3.out"
           });
       }
   });
}

cards.forEach(card => {
   card.addEventListener("mousemove", (e) => {

       if (window.innerWidth <= 768) return;

       const rect = card.getBoundingClientRect();

       const x = e.clientX - rect.left;
       const y = e.clientY - rect.top;


       const rotateY = (x / rect.width - 0.5) * 25;
       const rotateX = -(y / rect.height - 0.5) * 25;

       gsap.to(card, {
           rotateY: rotateY,
           rotateX: rotateX,
           duration: 0.3,
           ease: "power2.out"
       });
   });

   card.addEventListener("mouseleave", () => {

       let baseRotation = 0;

       if (card.classList.contains("strategy")) {
           baseRotation = -18;
       }
       else if (card.classList.contains("creative")) {
           baseRotation = -8;
       }
       else if (card.classList.contains("tech")) {
           baseRotation = 8;
       }
       else if (card.classList.contains("production")) {
           baseRotation = 18;
       }

       gsap.to(card, {
           rotateX: 0,
           rotateY: 0,
           rotation: baseRotation,
           duration: 0.5,
           ease: "power2.out"
       });
   });
});







