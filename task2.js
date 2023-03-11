const validationDesc = (words, min, desc) => {
    const result = {
        success: true,
        reason: []
    };

    if (desc.length < min) {
        result.success = false;
        result.reason.push('Недостаточное количество символов');
    }

    const repeatRegexp = /(\s{2,})|(\.{2,})/g;
    if (repeatRegexp.test(desc)) {
        result.success = false;
        result.reason.push('Содержит повторяющиеся подряд символы');
    }

    const phoneRegexp = /\+?[78][-(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}/g;
    if (phoneRegexp.test(desc)) {
        result.success = false;
        result.reason.push('Присутствует контактная информация');
    }

    const wordInDesc = desc.split(' ');
    const intersection = wordInDesc.filter((word) => words.includes(word));
    if (intersection.length) {
        result.success = false;
        result.reason.push('Содержит слова исключения');
    }


    return result;
};

console.log(validationDesc(['хата', 'рн', 'офигенно'], 200, '88005553535 хата  прилогается'));