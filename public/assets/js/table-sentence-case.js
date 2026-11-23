(() => {
    const ignoredSelector = 'a, button, input, select, textarea, script, style, code, pre, .no-sentence-case';

    const sentenceCase = (text) => {
        const parts = text.match(/^(\s*)([\s\S]*?)(\s*)$/);
        const leading = parts[1], content = parts[2], trailing = parts[3];

        if (!content || !/[A-Za-zÀ-ÿ]/.test(content) || /(?:https?:\/\/|www\.|@)/i.test(content)) {
            return text;
        }

        const acronyms = content.match(/\b[A-Z]{2,6}\b/g) || [];
        let result = content.toLocaleLowerCase('id-ID');

        [...new Set(acronyms)].forEach((acronym) => {
            const escaped = acronym.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            result = result.replace(new RegExp(`\\b${escaped.toLocaleLowerCase('id-ID')}\\b`, 'g'), acronym);
        });

        result = result.replace(/^([^A-Za-zÀ-ÿ]*)([a-zà-ÿ])/i, (match, prefix, first) => (
            prefix + first.toLocaleUpperCase('id-ID')
        ));

        return leading + result + trailing;
    };

    const formatTable = (table) => {
        const walker = document.createTreeWalker(table.tBodies[0] || table, NodeFilter.SHOW_TEXT);
        const nodes = [];
        let node;

        while ((node = walker.nextNode())) {
            if (!node.parentElement.closest(ignoredSelector)) {
                nodes.push(node);
            }
        }

        nodes.forEach((textNode) => {
            textNode.nodeValue = sentenceCase(textNode.nodeValue);
        });
    };

    const formatAllTables = () => document.querySelectorAll('table').forEach(formatTable);

    document.addEventListener('DOMContentLoaded', formatAllTables);

    if (window.jQuery) {
        window.jQuery(document).on('draw.dt', (event, settings) => formatTable(settings.nTable));
    }
})();
