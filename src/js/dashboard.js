const actionsContainer = document.getElementById('actions-container');
import { dashTile } from "./components/dashboard_tile.js";

// 'dashActions' comes from the server side PHP script and is injected at the top of the dashboard's HTML document.

dashActions.forEach((action) => {
    console.log(action);

    const tile = dashTile(action.name, action.path, action.thumbnail);

    actionsContainer.appendChild(tile);
});
