import {usePage} from "@inertiajs/vue3";

const asset = (file = null) => {
    if (!file)
        return null;
    return usePage().props.asset_url + (usePage().props.asset_url.endsWith('/') ? '' : '/') +
        (file.startsWith('/') ? file.substring(1) : file);
}
const exportExcel = (key = 'export_excel') => {
    let url = (window.location.href).split("?");
    window.location.href = (typeof url[1] == 'undefined' ? url[0] + '?' + key + '=true' : (window.location.href) + '&' + key + '=true');
}
const getAlignFrozen = () => {
    return usePage().props.lang.current === 'ar' ? 'right' : 'left';
}

const alertMessage = (message = null, type = 'success') => {
    usePage().props.toastr = [{type: type, title: '', message: message}];
}
const alertMessageHideElement = (event, message = null, type = 'success') => {
    event.target.setAttribute('disabled', 'disabled');

    event.target.classList.add('hidden');

    setTimeout(() => {
        event.target.classList.remove('hidden');
    }, 2000);
    usePage().props.toastr = [{type: type, title: '', message: message}];
}
const copy = async (item, toast, t) => {
    toast.add({
        severity: 'success',
        detail: t('message.copied_successfully'),
        life: 3000, // Duration in milliseconds
    });
    if (navigator.clipboard && window.isSecureContext) {
        return navigator.clipboard.writeText('{' + item + '}');
    } else {
        const textArea = document.createElement('textarea');
        textArea.value = `{${item}}`;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
        } catch (error) {
            console.error('Copy failed', error);
        } finally {
            textArea.remove();
        }
    }
};
const printContent = (content, duration = 1000) => {
    setTimeout(function () {
        var prtHtml = content;

        // Get all stylesheets HTML
        let stylesHtml = '';
        for (const node of [...document.querySelectorAll('link[rel="stylesheet"], style')]) {
            stylesHtml += node.outerHTML;
        }

        // Open the print window
        let WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

        WinPrint.document.write(`<!DOCTYPE html>
                <html dir="rtl">
                  <body>
                  <div class="page" style="height: 100%">
                    <div class="page-inner" style="height: 100%">
                        ${prtHtml}
                        </div>
                    </div>
                  </body>
                </html>`);
        WinPrint.document.close();
        WinPrint.focus();
        setTimeout(function () {
            WinPrint.print();
            WinPrint.close();
        }, duration);
    }, 1000);
}

const canAcceptSeries = (acceptances = []) => {
    for (const acceptancesKey in acceptances) {
        if (acceptances[acceptancesKey]['status'] === 'rejected')
            return false;
        if (acceptances[acceptancesKey]['status'] === 'pending' && acceptances[acceptancesKey]['user_id'] === usePage().props?.auth?.user?.id)
            return true;

        if (acceptances[acceptancesKey]['status'] !== 'accepted')
            return false;
    }
    return false;
}

export {
    asset, exportExcel, getAlignFrozen, copy, printContent, canAcceptSeries,
    alertMessage, alertMessageHideElement
}
