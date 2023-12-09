// On page load or when changing themes, best to add inline in `head` to avoid FOUC
export default {
    changeDarkMode() {
        if (!('theme' in localStorage)) localStorage.theme = 'dark';
        else if (localStorage.theme === 'dark') localStorage.theme = 'light';
        else this.removeDarkThem();

        this.loadTheme();
    },

    removeDarkThem() {
        localStorage.removeItem('theme')
    },

    loadTheme() {

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

    }
}



