export const categoryService = {
    async load(id) {
        const response = await fetch(`category/load/${id}`);
        const data = await response.json();
        return data.result;
    },

    async save(category) {
        const response = await fetch('category/save', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(category)
        });
        const data = await response.json();
        return data;
    },

    async update(category) {
        const response = await fetch('category/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(category)
        });
        const data = await response.json();
        return data;
    },

    async delete(id) {
        const response = await fetch(`category/delete/${id}`, { method: 'GET' });
        const data = await response.json();
        return data;
    },

    async list(filters = {}) {
        const params = new URLSearchParams();
        if (filters.nombre) params.append("nombre", filters.nombre);

        const response = await fetch(`category/list?${params.toString()}`);
        const data = await response.json();
        return data.result;
    }
};
