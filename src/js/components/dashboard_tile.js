const typeIcons = {
    "GET" : "./src/img/icons/action-types/link.svg",
    "POST" : "./src/img/icons/action-types/link.svg",
    "EXE" : "./src/img/icons/action-types/gear.svg",
    "NONE" : "./src/img/icons/action-types/magic-wand.svg"
};

function genWorkerURL(parameters) {
    const host = window.location.host;
    const protocol = window.location.protocol;
    let parameterString = '?';

    for (let key in parameters) {
        parameterString += `${key}=${parameters[key]}&`;
    }

    parameterString = parameterString.slice(0, -1);
    return `${protocol}//${host}/worker.php${parameterString}`;
}

export const dashTile = (tileName, scriptName, tileThumbnail) => {
    // Tile Element
    let tile = document.createElement('a');
    tile.classList.add(
        'w-1/5', 'rounded-md', 'h-35', 'min-w-30', 'cursor-pointer',
        'hover:shadow-md', 'flex', 'flex-col', 'relative', 'border-1'
    );
    tile.href = genWorkerURL({"sn" : scriptName, "tn" : tileName});

    // Tile Thumbnail 
    let thumbnail = document.createElement('img');
    thumbnail.classList.add('w-full', 'h-20', 'object-scale-down', 'object-center',
    'inset-shadown-md', 'bg-white', 'p-2', 'pt-4', 'rounded-t-md');
    thumbnail.src = tileThumbnail;
    tile.appendChild(thumbnail);

    // Tile Title
    let title = document.createElement('p');
    title.innerText = tileName;
    title.classList.add('text-lg', 'font-bold', 'text-sm', 'text-center', 'p-2',
    'justify-self-center');
    tile.appendChild(title);

    // Conditional Colors
    if (tileName.toLowerCase().includes('isolved')) {
        tile.classList.add('bg-pink-300', 'border-pink-300');
        title.classList.add('text-black');
    } else if (tileName.toLowerCase().includes('bullhorn')) {
        tile.classList.add('bg-orange-300', 'border-orange-300');
        title.classList.add('text-black');
    } else {
        tile.classList.add('bg-neutral-300', 'border-neutral-300');
        title.classList.add('text-black');
    }

    return tile;
}

