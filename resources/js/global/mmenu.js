import 'mmenu-js/dist/mmenu.css';
import Mmenu from 'mmenu-js';

export const initMmenu = () => {
    const menuElement = document.querySelector("#menu");

    if (!menuElement) {
        return;
    }

    new Mmenu(menuElement, {
        navbar: {
            add: true,
            title: "AB Inventech",
        },
        slidingSubmenus: false,
        offCanvas: {
            position: "left"
        },
        theme: "light",
        extensions: ["position-left", "position-front", "pagedim-black"],
        sidebar: {
            collapsed: {
                use: false
            },
            expanded: {
                use: "(min-width: 992px)"
            }
        }
    });
}
