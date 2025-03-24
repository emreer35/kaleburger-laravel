/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backgroundImage: {
                "custom-gradient":
                    "linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6))",
            },
        },
        colors: {
            transparent: "transparent",
            white: "#ffffff",
            gray: "#F5F5F5",
            button: "#F88F25",
            head: "#131416",
            text: "#3D3D3D",
            border : "#e0e0e0",
            ring: '#fca5a5',
            errortext : '#ef4444',
            border: '#374151',
            input:'#64748b',
            errorhover: '#b91c1c',
            greenbg: '#22c55e',
            greenhover: '#15803d',
            bordergray300 : '#d1d5db',
            bggreen600 : '#16a34a',
            gray200 : '#e5e7eb',
            green300: '#86efac',
            gray300: '#9ca3af',
            gray800: '#1f2937',
            gray400: '#9ca3af',
            blue500: '#3b82f6',
            gray50: '#f9fafb',

            green100: '#dcfce7',
            green400: '#4ade80',
            green700: '#15803d',
            red100: '#fee2e2',
            red400: '#f87171',
            red700: '#b91c1c'
        },
    },
    plugins: [],
};
