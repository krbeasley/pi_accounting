
export const dashTile = (tileInfo) => {
    const name = tileInfo.name;
    const type = tileInfo.type;
    const uri = tileInfo.uri;
    const domain = tileInfo.domain;
    const path = tileInfo.path;

    let tile = document.createElement('div');
    tile.classList.add('w-1/5', 'bg-neutral-200', 'rounded-md', 'p-6');

    let title = document.createElement('p');
    title.innerText = name;
    title.classList.add('text-lg', 'font-bold', 'text-sm');
    tile.appendChild(title);

    return tile;
}

