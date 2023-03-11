SELECT d.id, d.name, COUNT(u.id)
FROM users u INNER JOIN departments d on d.id = u.department_id
WHERE status = 'active'
GROUP BY d.id;