module.exports = {
  content: [
    "./*.php",
    "./public/*.{php,html}",
  ],
  theme: {
    extend: {
      fontSize: {
        'giant': '300px',
    },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
};

