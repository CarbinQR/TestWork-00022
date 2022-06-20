export const userMapper = user => ({
  id: user.id,
  login: user.login,
  email: user.email,
  createdAt: user.createdAt,
});
