<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
body {
  background-color: #000;
  font-family: "Signika Negative", sans-serif, Arial;
  overscroll-behavior: none;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

/* COLORS */
/* SCREEN BREAK POINTS FOR MEDIA QUERIES */
section {
  height: 100vh;
  padding: 0;
  /* SECTION THEMES */
}
section.whiteNavy {
  background-color: #fafcfc;
  color: #003246;
}

section.arc::after {
  border-radius: 100%;
  position: absolute;
  right: -200px;
  left: -200px;
  top: 80%;
  bottom: -268px;
  content: "";
}

#smooth-content {
  will-change: transform;
}
</style>
</head>
<body>

<div id="smooth-wrapper">
  <div id="smooth-content">
    <section class="whiteNavy">Section</section>
    <section class="whiteNavy">Section</section>
    <section class="whiteNavy">Section</section>
    <section class="whiteNavy">Section</section>
    <section class="whiteNavy">Section</section>
    <section class="whiteNavy">Section</section>
    <section class="whiteNavy">Section</section>
  </div>
</div>

<footer>
  <a href="https://greensock.com/scrollsmoother">
    <img class="greensock-icon" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/scroll-smoother-logo-light.svg" width="220" height="70" />
  </a>
  lkdfnvkdfnkvjndfkljn
</footer>
<!--<script src="assets/js/gsap.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
<script src="assets/js/ScrollSmoother.min.js"></script>
<script src="assets/js/ScrollToPlugin.min.js"></script>
<script src="assets/js/ScrollTrigger.min.js"></script>
<script>
//gsap.registerPlugin(ScrollTrigger, ScrollSmoother);
// create the smooth scroller FIRST!
let smoother = ScrollSmoother.create({
  smooth: 2, // seconds it takes to "catch up" to native scroll position
  effects: true // look for data-speed and data-lag attributes on elements and animate accordingly
});

// pin box-c when it reaches the center of the viewport, for 300px
ScrollTrigger.create({
  trigger: ".box-c",
  pin: true,
  start: "center center",
  end: "+=300"
});

</script>
</body>
</html>

