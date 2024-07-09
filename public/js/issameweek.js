function getWeekNumber(date) {
    const targetDate = new Date(date);
    const firstDayOfYear = new Date(targetDate.getFullYear(), 0, 1);
    const pastDaysOfYear = (targetDate - firstDayOfYear) / 86400000;

    return Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
}
function isSameWeek(date1, date2) {
    const d1 = new Date(date1);
    const d2 = new Date(date2);

    // Compare years
    if (d1.getFullYear() !== d2.getFullYear()) {
        return false;
    }
    // Compare week numbers
    return getWeekNumber(d1) === getWeekNumber(d2);
}