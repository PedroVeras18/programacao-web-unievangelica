import { z } from 'zod'
import { FastifyReply, FastifyRequest } from 'fastify'
import { MakeGetAllCarsUseCase } from '@/use-cases/factories/make-car-factory'

export async function getAllCarsController(
  request: FastifyRequest,
  reply: FastifyReply,
) {
  const getAllCarsBodySchema = z.object({
    page: z.coerce.number().default(1),
  })

  const { page } = getAllCarsBodySchema.parse(request.body)

  const getAllCarsUseCase = MakeGetAllCarsUseCase()

  const cars = await getAllCarsUseCase.execute({
    page,
  })

  return reply.status(201).send({
    cars,
  })
}
