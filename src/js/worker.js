// const dashActions (array<JSONObject>)    - injected into the HTML by the server
// const scriptName (string)                - injected into the HTML by the server 
//
// dashActions will be empty if there was something wrong loading the server stored dash_actions file.
import { fileUploadTile } from "./components/worker_form_file_input.js";

const form = document.getElementById('worker-form');
const uploadsContainer = document.getElementById('uploads-container');
const formTitleElement = document.getElementById('worker-title');

let x = 0;
dashActions.forEach((action) => {
    x++;
    if (action['path'] === scriptName) {
        formTitleElement.innerText = action['name'];
        const args = action['arguments'];

        if (args) {
            for (let key in args) {
                if (args[key].toString().includes('file')) {
                    const tileName = key;

                    uploadsContainer.appendChild(fileUploadTile(tileName))
                }
            }
        }
    }
})

if (uploadsContainer.childNodes.length === 1) {
    console.log("1 element");
    uploadsContainer.classList.replace('grid-cols-2', 'grid-cols-1');
}
