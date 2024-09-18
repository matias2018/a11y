// get buttons
function select(selector) {
  return document.querySelector(selector);
}

const settingsButton = select('.openSettings');
const saveAndCloseButton = select('.saveAndClose');
const useReducedMotionBtn = select('.useReducedMotion');
const useDarkModeBtn = select('.useDarkMode');
const highContrastBtn = select('.useHighContrast');
const useAnimationBtn = select('.useAnimation');
const decreaseFontBtn = select('#decreaseFontSize');
const increaseFontBtn = select('#increaseFontSize');


// function to toggle class on all elements
function toggleClassOnAllElements(className) {
  document.body.classList.toggle(className);
}

const useReducedMotion = localStorage.getItem('useReducedMotion');
const useDarkMode = localStorage.getItem('useDarkMode');
const useHighContrast = localStorage.getItem('useHighContrast');
const useAnimation = localStorage.getItem('useAnimation');

// DARK MODE
// if the user has set a preference for darkmode add class="font-sans antialiased dark:bg-black dark:text-white/50" to the body so it can be used with tailwindcss and bootstrap
if (useDarkMode === 'true') {
  useDarkModeBtn.checked = true;
  toggleClassOnAllElements('darkMode');
  toggleClassOnAllElements('font-sans');
  toggleClassOnAllElements('antialiased');
  toggleClassOnAllElements('dark:bg-black');
  toggleClassOnAllElements('dark:text-white/50');
}
// Event listener
useDarkModeBtn.addEventListener('click', toggleDarkMode);
// use dark mode
function toggleDarkMode() {
  const setDarkMode = !localStorage.getItem('useDarkMode');
  toggleClassOnAllElements('darkMode');

  // Store the current state in localStorage
  const useDarkMode = document.body.classList.contains('darkMode');
  localStorage.setItem('useDarkMode', useDarkMode.toString());
}

// HIGH CONTRAST
// check if the user has set a preference for high contrast mode
if (useHighContrast === 'true') {
  document.body.classList.add('highContrast');
  highContrastBtn.checked = true;
}
// Event listener
highContrastBtn.addEventListener('click', toggleHighContrast);
// use high contrast
function toggleHighContrast() {
  const setHighContrast = !localStorage.getItem('useHighContrast');
  toggleClassOnAllElements('highContrast');

  // Store the current state in localStorage
  const isHighContrast = document.body.classList.contains('highContrast');
  localStorage.setItem('useHighContrast', isHighContrast.toString());
}

// REDUCED MOTION
// check if the user has set a preference for reduced motion
if (useReducedMotion === 'true') {
  toggleClassOnAllElements('reduceMotion');
  useReducedMotionBtn.checked = true;
  toggleAnimation(false);
  // This is a temporary fix for the waves animation
  select('.hero-waves').classList.toggle('hidden-true');
}

// Event listener
useReducedMotionBtn.addEventListener('click', toggleReducedMotion);
// use reduced motion
function toggleReducedMotion() {
  const useReducedMotion = !document.body.classList.contains('reduceMotion');
  document.body.classList.toggle('reduceMotion');

  toggleAnimation(!useReducedMotion);

  localStorage.setItem('useReducedMotion', useReducedMotion.toString());
}


// ANIMATIONS
// check if the user has set a preference for animations
if (useAnimation === 'true') {
  document.body.classList.add('useAnimation');
  useAnimationBtn.checked = true;
} else {
  toggleAnimation(true);
  useAnimationBtn.checked = false;
}
// Event listener
useAnimationBtn.addEventListener('click', toggleAnimation);

// use animations
function toggleAnimation(disable = false) {
  const useAnimation = !document.body.classList.contains('useAnimation');
  // document.body.classList.toggle('useAnimation');

  localStorage.setItem('useAnimation', useAnimation.toString());

  toggleClassOnAllElements('useAnimation');
  AOS.init({
    disable: disable,
  });
  select('.hero-waves').classList.toggle('hidden-true');
  select('.animated').classList.toggle('paused');
}

function disableAllAnimations() {
  const elements = document.querySelectorAll('*');
  elements.forEach((element) => {
    element.style.animation = 'none';
    element.style.transition = 'none';
  });

  const animationLibraries = [
    {name: 'anime.js', selector: '[data-animejs]',},
    {name: 'AOS', selector: '[data-aos]',},
    {name: 'lottie', selector: '[data-lottie]',},
    {name: 'ScrollReveal', selector: '[data-scroll-reveal]',},
    {name: 'Three.js', selector: '[data-threejs]',},
    {name: 'GSAP', selector: '[data-gsap]',},
    {name: 'Velocity.js', selector: '[data-velocity]',},
  ];

  animationLibraries.forEach((lib) => {
    const elements = document.querySelectorAll(lib.selector);
    if (elements.length > 0) {
      if (lib.name === 'anime.js'){
        anime.pause();
      } else if (lib.name === 'GSAP') {
        gsap.pauseAll();
      } else if (lib.name === 'lottie') {
        lottie.pause();
      } else if (lib.name === 'ScrollReveal') {
        ScrollReveal().destroy();
      } else if (lib.name === 'Three.js') {
        // three.js
        // three.js animations are handled by the render loop
        clock.stop();
      } else if (lib.name === 'Velocity.js') {
        // Velocity.js
        Velocity.Utilities.removeData(elements);
      }
    }
  });
}

// FONT SIZE
// adjust font size; Will not store the font size in localStorage
const body = document.body;
const initialFontSize = parseFloat(getComputedStyle(body).fontSize);
let currentFontSize = initialFontSize;

function adjustFontSize(sizeChange) {
  // Implement checks to avoid excessively large or small font sizes (optional)
  if (currentFontSize + sizeChange < 10) {
    return; // Prevent font size below a minimum
  } else if (currentFontSize + sizeChange > 32) {
    return; // Prevent font size exceeding a maximum
  }

  currentFontSize += sizeChange;
  const letterSpacing = currentFontSize / 10;

  body.style.fontSize = `${currentFontSize}px`;
  body.style.letterSpacing = `${letterSpacing}px`;
}

decreaseFontBtn.addEventListener('click', () => adjustFontSize(-2));
increaseFontBtn.addEventListener('click', () => adjustFontSize(2));


// Close and save settings
saveAndCloseButton.addEventListener('click', () => {
  document.body.classList.remove('settingsOpen');
  // reload the page to apply the changes
  location.reload();
});