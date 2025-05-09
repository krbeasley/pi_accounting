
export const fileUploadTile = (tileName) => {
    let tile = document.createElement('div');
    tile.classList.add('flex', 'flex-col', 'w-fit', 'mx-auto');

    // label
    let label = document.createElement('label');
    tile.appendChild(label);
    label.innerText = `Select your ${tileName} file.`;
    label.classList.add('block', 'mb-2', 'text-sm', 'font-medium', 'text-grey-900', 'capitalize', 'px-2');

    // file input
    let fileInput = document.createElement('input');
    tile.appendChild(fileInput);
    fileInput.type = 'file';
    fileInput.name = `${tileName}_upload`;
    fileInput.classList.add("block", "w-full", "text-sm", "text-gray-900", "border", "border-gray-300", 
        "rounded-lg", "cursor-pointer", "bg-gray-50", "focus:outline-none", "p-2");
    fileInput.required = true;

    return tile;
}
