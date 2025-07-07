export const userService = {
    async load(id) {
        const response = await fetch(`user/load/${id}`);
        const data = await response.json();
        return data.result;
    },

    async save(user) {
        const response = await fetch('user/save', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(user)
        });

        const data = await response.json();
        return data; // Devuelve el objeto completo, no solo data.message
    },

    async update(user) {
        const response = await fetch('user/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(user)
        });

        const data = await response.json();
        return data;
    },

    async delete(id) {
        const response = await fetch(`user/delete/${id}`, {
            method: 'GET'
        });

        const data = await response.json();
        return data;
    },

    async list(filters = {}) {
        const params = new URLSearchParams();

        if (filters.cuenta) params.append("cuenta", filters.cuenta);
        if (filters.correo) params.append("correo", filters.correo);
        if (filters.perfil) params.append("perfil", filters.perfil);

        const response = await fetch(`user/list?${params.toString()}`);
        const data = await response.json();
        return data.result;
    },

    async enable(id) {
        const response = await fetch(`user/enable/${id}`, { method: 'PUT' });
        const data = await response.json();
        return data;
    },

    async disable(id) {
        const response = await fetch(`user/disable/${id}`, { method: 'PUT' });
        const data = await response.json();
        return data;
    },

    async reset(id) {
        const response = await fetch(`user/reset/${id}`, { method: 'PUT' });
        const data = await response.json();
        return data;
    },

    async getCurrent() {
        const response = await fetch(`user/getCurrent`);
        const data = await response.json();

        if (data.error) {
            console.warn("getCurrent() error:", data.error);
            return null;
        }

        return data.result;
    },
    async changePassword(currentPassword, newPassword, confirmPassword) {
        const payload = {
            currentPassword,
            newPassword,
            confirmPassword
        };

        const response = await fetch(`user/changePassword`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await response.json();
        return data;
    }
};
