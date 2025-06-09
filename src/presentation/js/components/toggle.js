export default function toggleComponent() {
    return {
        show: false,
        
        toggle() {
            this.show = !this.show;
        },

        init() {
            console.log('Componente de toggle inicializado');
        }
    }
} 