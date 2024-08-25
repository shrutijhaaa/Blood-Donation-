function showDetails(element) {
  // Pause the scroll animation
  document.querySelector('.scroll-container').classList.add('paused');
  
  // Add any necessary visual changes to the clicked box (optional)
  element.classList.add('highlighted');
}



    // JavaScript to stop scrolling when the user clicks on the event-scroller
    const eventScroller = document.querySelector('.event-scroller');

    eventScroller.addEventListener('click', function() {
        this.classList.toggle('paused');
    });
