/* eslint-disable @typescript-eslint/no-explicit-any */
import { api } from './api'

export const login = async data => {
  const result = await api.post('/login', data)

  //set interceptor for bearer token
  api.interceptors.request.use(config => {
    const token = result.data.token ?? null
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }

    console.log(config.headers)
    return config
  })

  return result.data
}

export const register = async data => {
  const result = await api.post('/register', data, {
    headers: {
      'Content-Type': 'application/json',
    },
  })
  return result.data
}
