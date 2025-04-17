
document.addEventListener("DOMContentLoaded", function () {
  let allValues = document.querySelectorAll(".value");

  function startCounter(singleValue) {
    let startValue = 0;
    let endValue = parseInt(singleValue.getAttribute("data-value"));
    let timeDuration = parseFloat(singleValue.getAttribute("time-duration")) * 1000; // Convert seconds to milliseconds
    let increment = Math.ceil(endValue / (timeDuration / 30)); // Adjust step size

    let counter = setInterval(function () {
      startValue = startValue + increment;
      if (startValue >= endValue) {
        singleValue.textContent = endValue; // Ensure exact final value
        clearInterval(counter);
      } else {
        singleValue.textContent = startValue;
      }
    }, 30); // Update every 30ms for smooth effect
  }

  // **Intersection Observer**
  let observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          let targetValue = entry.target;
          if (!targetValue.dataset.animated) { // Prevent multiple triggers
            startCounter(targetValue);
            targetValue.dataset.animated = "true"; // Mark as animated
          }
        }
      });
    },
    { threshold: 0.5 } // 50% of the element should be visible
  );

  // Observe each counter
  allValues.forEach((value) => {
    observer.observe(value);
  });
});
