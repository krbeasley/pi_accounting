const typeIcons = {
    "GET" : "./src/img/icons/action-types/link.svg",
    "POST" : "./src/img/icons/action-types/link.svg",
    "EXE" : "./src/img/icons/action-types/gear.svg",
    "NONE" : "./src/img/icons/action-types/magic-wand.svg"
};

export const dashTile = (tileInfo) => {
    const name = tileInfo.name;
    const type = tileInfo.type;
    const uri = tileInfo.uri;
    const domain = tileInfo.domain;
    const path = tileInfo.path;
    const thumb = tileInfo.thumbnail;

    // Tile Element
    let tile = document.createElement('a');
    tile.classList.add(
        'w-1/5', 'bg-neutral-200', 'rounded-md', 'h-35', 'min-w-30',
        'hover:shadow-md', 'flex', 'flex-col', 'relative', 'border-1',
        'border-neutral-200', 'cursor-pointer'
    );
    tile.href = (domain) ? `https://${domain}${uri}` : `./worker.php?sn=${path}`; 

    // Tile Thumbnail 
    let thumbnail = document.createElement('img');
    thumbnail.classList.add('w-full', 'h-20', 'object-scale-down', 'object-center',
    'inset-shadown-md', 'bg-white', 'p-2', 'pt-4', 'rounded-t-md');
    thumbnail.src = thumb;
    tile.appendChild(thumbnail);

    // Tile Title
    let title = document.createElement('p');
    title.innerText = name;
    title.classList.add('text-lg', 'font-bold', 'text-sm', 'text-center', 'p-2',
    'justify-self-center');
    tile.appendChild(title);

    // Tile Icon
    let icon = document.createElement('img');
    icon.src = typeIcons[type.toUpperCase()] ?? "NONE";
    icon.classList.add('h-6', 'w-6', 'p-1', 'absolute', 'top-[1px]', 'right-[1px]', 'opacity-60');
    tile.appendChild(icon);

    return tile;
}

