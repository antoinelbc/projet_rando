const levels = document.querySelectorAll(".level-hiking");

levels.forEach((level) => {
    level.addEventListener("click", () => {
        if (level.classList.contains("is-open")) {
            level.classList.remove("is-open");
        } else {
            const levelsClassIsOpen = document.querySelectorAll(".is-open");

            levelsClassIsOpen.forEach((levelClassIsOpen) => {
                levelClassIsOpen.classList.remove("is-open");
            });
            level.classList.add("is-open");
        }
    });
});
