window.addEventListener("DOMContentLoaded", () => {

    function toggleDarkMode() {
        let darkMode = localStorage.getItem('theme') === 'true'
        darkMode = !darkMode
        localStorage.setItem('theme', darkMode)
    }
    
    function refreshTheme() {
        const darkMode = localStorage.getItem('theme') === 'true'
        const backgroundImage = document.querySelector('.background')
        const button = document.querySelector(".button__logo")
        if(darkMode){
            button.innerHTML = '<i class="fa-solid fa-sun"></i>';
        }else{
            button.innerHTML = '<i class="fa-solid fa-moon"></i>';
        }
        if (backgroundImage)
            backgroundImage.classList.toggle('dark-mode', darkMode)
            document.documentElement.classList.toggle('dark-mode', darkMode)
    }
    
    refreshTheme()
    const switchTheme = document.querySelector('.changeTheme')
    
    switchTheme.addEventListener('click', () => {
        toggleDarkMode()
        refreshTheme()
    })
});
