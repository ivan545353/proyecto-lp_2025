export const itemService = {
    async load(id) {
        const response = await fetch(`item/load/${id}`);
        const data = await response.json();
        return data.result;
    },

    async save(producto) {
        const response = await fetch('item/save', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(producto)
        });
        const data = await response.json();
        return data;
    },

    async update(producto) {
        const response = await fetch('item/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(producto)
        });
        const data = await response.json();
        return data;
    },

    async delete(id) {
        const response = await fetch(`item/delete/${id}`, { method: 'GET' });
        const data = await response.json();
        return data;
    },

    async list(filters = {}) {
        const response = await fetch(`item/list`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(filters)
        });

        const data = await response.json();
        return data.result;
    }
};
