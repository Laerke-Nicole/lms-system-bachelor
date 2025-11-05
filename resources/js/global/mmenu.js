import 'mmenu-js/dist/mmenu.css';
import Mmenu from 'mmenu-js';

export const initMmenu = () => {
    const menu = new Mmenu("#menu", {
        navbar: {
            add: true,
            title: "Ab-Inventech",
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
