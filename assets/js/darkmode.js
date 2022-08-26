function toggleDarkMode() {
    let darkMode = localStorage.getItem('theme') === 'true'
    darkMode = !darkMode
    localStorage.setItem('theme', darkMode)
}

function refreshTheme() {
    const darkMode = localStorage.getItem('theme') === 'true'
    const backgroundImage = document.querySelector('.background')

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