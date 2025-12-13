(function($){
  // Placeholder JS for the theme
  $(function(){
    console.log('Web Design Feed theme loaded');
  });
})(jQuery);


// Sidebar toggle for viewports <= 1918px
      (function(){
        var toggle = document.getElementById('sidebarToggle');
        var body = document.body;
        var backdrop = document.getElementById('sidebarBackdrop');
        var sidebar = document.getElementById('siteSidebar');
        var sidebarClose = document.getElementById('sidebarClose');

        function closeSidebar(){
          body.classList.remove('sidebar-open');
          toggle && toggle.setAttribute('aria-expanded','false');
        }

        function openSidebar(){
          body.classList.add('sidebar-open');
          toggle && toggle.setAttribute('aria-expanded','true');
        }

        if(toggle){
          toggle.addEventListener('click', function(e){
            if(window.innerWidth <= 1918){
              if(body.classList.contains('sidebar-open')) closeSidebar(); else openSidebar();
            }
          });
        }

        if(sidebarClose){
          sidebarClose.addEventListener('click', function(){
            closeSidebar();
          });
        }

        if(backdrop){
          backdrop.addEventListener('click', closeSidebar);
        }

        // Close when a sidebar link is clicked (mobile)
        if(sidebar){
          sidebar.addEventListener('click', function(e){
            if(e.target.tagName === 'A' && window.innerWidth <= 1918){
              closeSidebar();
            }
          });
        }

        // Ensure sidebar state resets on resize beyond breakpoint
        window.addEventListener('resize', function(){
          if(window.innerWidth > 1918){
            body.classList.remove('sidebar-open');
            toggle && toggle.setAttribute('aria-expanded','false');
          }
        });
      })();