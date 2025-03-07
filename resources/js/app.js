import 'flowbite/dist/flowbite.min.js'
import './bootstrap';

import Chart from 'chart.js/auto';

window.Chart = Chart

import {livewire_hot_reload} from 'virtual:livewire-hot-reload'

livewire_hot_reload();

document.addEventListener("DOMContentLoaded", function () {
    const tooltips = document.querySelectorAll("[data-tooltip-target]");
    tooltips.forEach(tooltip => {
        const targetId = tooltip.getAttribute("data-tooltip-target");
        const target = document.getElementById(targetId);
        if (target) {
            tooltip.addEventListener("mouseenter", () => {
                target.classList.remove("invisible", "opacity-0");
            });
            tooltip.addEventListener("mouseleave", () => {
                target.classList.add("invisible", "opacity-0");
            });
        }
    });
});
