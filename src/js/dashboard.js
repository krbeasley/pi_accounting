const actionsContainer = document.getElementById('actions-container');
import { dashTile } from "./components/dashboard_tile.js";

// 'dashActions' comes from the server side PHP script and is injected at the top of the dashboard's HTML document.

dashActions.forEach((action) => {
    let tile = dashTile(action);

    console.log(`Adding ${action.name}`);

    actionsContainer.appendChild(tile);
});
